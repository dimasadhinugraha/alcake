<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil data asli dari database, urutin dari yang terbaru
        $orders = Order::orderBy('created_at', 'desc')->get();

        $availableProducts = Product::orderBy('name')
            ->get()
            ->map(function (Product $product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                ];
            })
            ->values();

        return view('orders.index', compact('orders', 'availableProducts'));
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'customer' => 'required|string|max:255',
            'status' => 'required|string',
            'order_date' => 'required|date',
            'finish_date' => 'required|date',
            'products' => 'required|array|min:1', // Keranjang ga boleh kosong
        ]);

        // 2. Validasi ketentuan tanggal selesai (minimal +2 hari)
        $minFinishDate = date('Y-m-d', strtotime($request->order_date . ' + 2 days'));
        if ($request->finish_date < $minFinishDate) {
            return redirect()->back()->withErrors(['finish_date' => 'Tanggal selesai minimal +2 hari dari tanggal pemesanan!'])->withInput();
        }

        // 3. Hitung Total Harga dari keranjang
        $total = 0;
        foreach ($request->products as $item) {
            $total += $item['subtotal'];
        }

        // 4. Simpan ke Database
        Order::create([
            'customer' => $request->customer,
            'status' => $request->status,
            'order_date' => $request->order_date,
            'finish_date' => $request->finish_date,
            'notes' => $request->notes,
            'total' => $total,
            'products' => $request->products,
        ]);

        // 5. Lempar balik dengan pesan sukses
        return redirect()->back()->with('success', 'Pesanan baru berhasil dibuat dan disimpan!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi inputan
        $request->validate([
            'customer' => 'required|string|max:255',
            'status' => 'required|string',
            'order_date' => 'required|date',
            'finish_date' => 'required|date',
            'products' => 'required|array|min:1',
        ]);

        // 2. Validasi ketentuan tanggal selesai (minimal +2 hari)
        $minFinishDate = date('Y-m-d', strtotime($request->order_date . ' + 2 days'));
        if ($request->finish_date < $minFinishDate) {
            return redirect()->back()->withErrors(['finish_date' => 'Tanggal selesai minimal +2 hari dari tanggal pemesanan!'])->withInput();
        }

        $total = 0;
        foreach ($request->products as $item) {
            $total += $item['subtotal'];
        }

        $order = Order::findOrFail($id);
        $order->update([
            'customer' => $request->customer,
            'status' => $request->status,
            'order_date' => $request->order_date,
            'finish_date' => $request->finish_date,
            'notes' => $request->notes,
            'total' => $total,
            'products' => $request->products,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil diperbarui!');
    }
}
