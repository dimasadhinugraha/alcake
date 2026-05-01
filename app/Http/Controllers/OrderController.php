<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil data asli dari database, urutin dari yang terbaru
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Data produk untuk dropdown (bisa diganti ambil dari DB Product nanti)
        $availableProducts = [
            'Kue Ulang Tahun Coklat - Rp 250.000',
            'Black Forest - Rp 280.000',
            'Nastar - Rp 75.000',
            'Tiramisu Cup - Rp 35.000',
            'Klapertart - Rp 150.000',
            'Putri Salju - Rp 70.000'
        ];

        return view('orders.index', compact('orders', 'availableProducts'));
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'customer' => 'required|string|max:255',
            'status' => 'required|string',
            'order_date' => 'required|date',
            'products' => 'required|array|min:1', // Keranjang ga boleh kosong
        ]);

        // 2. Hitung Total Harga dari keranjang
        $total = 0;
        foreach ($request->products as $item) {
            $total += $item['subtotal'];
        }

        // 3. Kalkulasi Estimasi Selesai (+2 Hari)
        $finish_date = date('Y-m-d', strtotime($request->order_date. ' + 2 days'));

        // 4. Simpan ke Database
        Order::create([
            'customer' => $request->customer,
            'status' => $request->status,
            'order_date' => $request->order_date,
            'finish_date' => $finish_date,
            'notes' => $request->notes,
            'total' => $total,
            'products' => $request->products,
        ]);

        // 5. Lempar balik dengan pesan sukses
        return redirect()->back()->with('success', 'Pesanan baru berhasil dibuat dan disimpan!');
    }
}
