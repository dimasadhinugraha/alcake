<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialHistory; // Jangan lupa panggil model riwayatnya
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        // 1. Ambil data stok asli dari database
        $materials = Material::orderBy('name', 'asc')->get()->map(function($item) {
            // Logika otomatis nentuin status Aman / Rendah
            $item->status = $item->stock <= $item->min_stock ? 'Stok Rendah' : 'Stok Aman';
            return $item;
        });

        $stokAman = $materials->where('status', 'Stok Aman')->count();
        $stokRendah = $materials->where('status', 'Stok Rendah')->count();
        $totalBahan = $materials->count();

        // 2. Ambil riwayat masuk (inbound) dari database
        $inboundHistory = MaterialHistory::where('type', 'inbound')->orderBy('created_at', 'desc')->get()->map(function($h) {
            return (object)[
                'date' => $h->created_at->translatedFormat('d M Y'),
                'time' => $h->created_at->format('H.i'),
                'name' => $h->material_name,
                'qty' => '+' . $h->qty,
                'notes' => $h->notes ?? 'Penambahan stok manual'
            ];
        });

        // 3. Ambil riwayat keluar (outbound) dari database
        $outboundHistory = MaterialHistory::where('type', 'outbound')->orderBy('created_at', 'desc')->get()->map(function($h) {
            return (object)[
                'date' => $h->created_at->translatedFormat('d M Y'),
                'time' => $h->created_at->format('H.i'),
                'name' => $h->material_name,
                'qty' => '-' . $h->qty,
                'notes' => $h->notes ?? 'Pengurangan stok',
                'product' => $h->product_name ?? 'Produksi Umum'
            ];
        });

        return view('materials.index', compact('materials', 'stokAman', 'stokRendah', 'totalBahan', 'inboundHistory', 'outboundHistory'));
    }

    // Fungsi: Modal Tambah Bahan Baku Baru (Warna Pink)
// Fungsi: Modal Tambah Bahan Baku Baru (Warna Pink)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:materials,name',
            'unit' => 'required|string',
            'stock' => 'required|numeric|min:0',
            'min_stock' => 'required|numeric|min:0',
        ], [
            'name.unique' => 'Gagal! Bahan baku dengan nama tersebut sudah ada di database.'
        ]);

        // 1. Simpan bahan baku ke database & simpan datanya ke variabel $newMaterial
        $newMaterial = Material::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
        ]);

        // 2. Catat ke riwayat otomatis (Pakai ID dari $newMaterial)
        if ($request->stock > 0) {
            MaterialHistory::create([
                'material_id' => $newMaterial->id, // <--- INI KUNCINYA
                'material_name' => $newMaterial->name,
                'type' => 'inbound',
                'qty' => $request->stock,
                'notes' => 'Input bahan baku baru'
            ]);
        }

        return redirect()->back()->with('success', 'Bahan baku baru berhasil ditambahkan!');
    }

    // Fungsi: Modal Tambah Stok (Warna Hijau)
    public function updateStock(Request $request)
    {
        $request->validate([
            'material_name' => 'required|string',
            'qty' => 'required|numeric|min:0.1',
        ]);

        // 1. Cari bahan bakunya
        $material = Material::where('name', $request->material_name)->firstOrFail();

        // 2. Tambahin stoknya
        $material->stock += $request->qty;
        $material->save();

        // 3. Catat ke riwayat masuk (Pakai ID dari $material)
        MaterialHistory::create([
            'material_id' => $material->id, // <--- INI KUNCINYA
            'material_name' => $material->name,
            'type' => 'inbound',
            'qty' => $request->qty,
            'notes' => 'Penambahan stok (Restock)'
        ]);

        return redirect()->back()->with('success', 'Stok berhasil ditambah!');
    }

}
