<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use App\Models\Transaction; // Sesuaikan jika nama model lu 'Order'
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Menu Katalog (Hitung semua produk)
        $totalMenu = Product::count();

        // 2. Pesanan Aktif (Asumsi: Status transaksi bukan 'Selesai')
        // Kalau kolom status lu namanya beda, sesuaikan aja ya!
        $pesananAktif = Transaction::where('status', '!=', 'Selesai')->count();

        // 3. Pesanan Bulan Ini (Hitung transaksi di bulan & tahun ini)
        $pesananBulanIni = Transaction::whereMonth('created_at', Carbon::now()->month)
                                      ->whereYear('created_at', Carbon::now()->year)
                                      ->count();

        // 4. Bahan Baku Rendah (Stok di bawah atau sama dengan stok minimum)
        // Gunakan whereRaw untuk ngebandingin 2 kolom di database
        $bahanBakuRendah = Material::whereRaw('stock <= min_stock')->count();

        // 5. Pesanan Terbaru (Ambil 5 transaksi terakhir)
        $pesananTerbaru = Transaction::orderBy('created_at', 'desc')->take(5)->get();

        // 6. Menu Terpopuler (Ambil 4 produk - untuk sementara kita ambil produk terbaru/random jika belum ada relasi detail transaksi)
        $menuTerpopuler = Product::take(4)->get();

        return view('dashboard', compact(
            'totalMenu',
            'pesananAktif',
            'pesananBulanIni',
            'bahanBakuRendah',
            'pesananTerbaru',
            'menuTerpopuler'
        ));
    }
}
