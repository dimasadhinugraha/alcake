<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order; // Panggil model Order biar bisa baca tabel pesanan
use Illuminate\Http\Request;
use Carbon\Carbon; // Buat format tanggal

class TransactionController extends Controller
{
    public function index()
    {
        // 1. Ambil data transaksi dari database
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        // 2. AUTO-KALKULASI STATISTIK DARI DATABASE
        $totalPendapatan = $transactions->sum('paid');
        $totalBelumLunas = $transactions->where('status', 'Belum Lunas')->sum(function($trx) {
            return $trx->total - $trx->paid;
        });
        $totalLunas = $transactions->where('status', 'Lunas')->sum('paid');

        // 3. AMBIL DATA PESANAN ASLI DARI DATABASE (The Magic 🪄)
        // Kita ambil pesanan yang belum selesai aja biar dropdown-nya gak kepanjangan
        $pendingOrders = Order::where('status', '!=', 'Selesai')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($order) {
                // Kita format datanya biar cocok sama struktur JavaScript di Blade lu
                return (object)[
                    'id' => $order->id,
                    'customer' => $order->customer,
                    'total' => $order->total,
                    'order_date' => Carbon::parse($order->order_date)->translatedFormat('d M Y'),
                    'deadline' => Carbon::parse($order->finish_date)->translatedFormat('d M Y'),
                    'products' => $order->products
                ];
            });

        return view('transactions.index', compact('transactions', 'pendingOrders', 'totalPendapatan', 'totalBelumLunas', 'totalLunas'));
    }

    // FUNGSI BUAT TRANSAKSI BARU (Menyimpan data ke tabel transactions)
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_date' => 'required|date',
            'type' => 'required|string',
            'paid' => 'required|numeric|min:1',
        ]);

        // Cari data pesanan aslinya
        $order = Order::findOrFail($request->order_id);

        // Otomatis tentuin status: Kalau bayarnya kurang dari total, berarti "Belum Lunas"
        $status = ($request->paid >= $order->total) ? 'Lunas' : 'Belum Lunas';

        // Simpan ke tabel Transaksi
        Transaction::create([
            'customer' => $order->customer,
            'admin' => 'Admin Alva Cake', // Nanti bisa diganti pakai Auth::user()->name
            'type' => $request->type, // Lunas / DP
            'status' => $status,
            'paid' => $request->paid,
            'total' => $order->total,
            'payment_date' => $request->payment_date,
            'products' => $order->products, // Copy detail produk dari order ke nota transaksi
        ]);

        // Opsional: Kalau udah lunas, status pesanannya bisa otomatis diubah jadi "Diproses" atau "Selesai"
        if($status == 'Lunas' && $order->status == 'Pending') {
            $order->update(['status' => 'Diproses']);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil diproses!');
    }

    // FUNGSI PELUNASAN
    public function settle(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Ubah sisa pembayaran jadi terbayar full
        $transaction->paid = $transaction->total;
        $transaction->status = 'Lunas';

        // Simpan tanggal pelunasan jika perlu
        if($request->has('payment_date')) {
            $transaction->payment_date = $request->payment_date;
        }

        $transaction->save();

        return redirect()->back()->with('success', 'Transaksi berhasil dilunasi! Pendapatan otomatis bertambah.');
    }
}