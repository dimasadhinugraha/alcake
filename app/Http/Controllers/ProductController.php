<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Tampilkan Halaman Katalog Kue
    public function index()
    {
        // Ambil data kue dari database, urutin dari yang terbaru, kasih pagination 9 data per halaman
        $products = Product::with('categoryRelation')->orderBy('created_at', 'desc')->paginate(9);

        // Ambil daftar kategori asli dari database
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    // 2. Simpan Kue Baru (Proses Tambah)
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $cat = \App\Models\Category::findOrFail($request->category_id);

        // Simpan ke database
        Product::create([
            'name' => $request->name,
            'category' => $cat->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => 0, // Konsep Pre-Order: stok awal selalu 0 unit
        ]);

        return redirect()->route('products.index')->with('success', 'Kue baru berhasil ditambahkan!');
    }

    // 3. Update Data Kue (Proses Edit)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi data input (abaikan validasi unik untuk nama kue yang sama dengan dirinya sendiri)
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,'.$product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $cat = \App\Models\Category::findOrFail($request->category_id);

        // Update data ke database
        $product->update([
            'name' => $request->name,
            'category' => $cat->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Data kue berhasil diperbarui!');
    }

    // 4. Hapus Kue
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Kue berhasil dihapus dari katalog!');
    }
}
