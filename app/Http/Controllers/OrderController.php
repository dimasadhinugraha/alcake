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

        // Fetch materials and recipes
        $materials = \App\Models\Material::all()->map(function($m) {
            return [
                'name' => $m->name,
                'stock' => (float) $m->stock,
                'unit' => $m->unit
            ];
        })->values();

        $recipes = \App\Models\Recipe::with('ingredients')->get()->map(function($r) {
            return [
                'product_name' => $r->product_name,
                'ingredients' => $r->ingredients->map(function($i) {
                    return [
                        'name' => $i->name,
                        'qty' => (float) $i->qty,
                        'unit' => $i->unit
                    ];
                })
            ];
        })->values();

        return view('orders.index', compact('orders', 'availableProducts', 'materials', 'recipes'));
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'customer' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
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

        // Check stock if status is directly "Diproses"
        if ($request->status === 'Diproses') {
            // First check if recipe is complete for all products
            foreach ($request->products as $product) {
                $recipe = \App\Models\Recipe::where('product_name', $product['name'])->first();
                if (!$recipe) {
                    return redirect()->back()->with('error', 'Resep tidak lengkap untuk semua produk dalam pesanan ini');
                }
            }

            $errors = [];
            foreach ($request->products as $product) {
                $recipe = \App\Models\Recipe::where('product_name', $product['name'])->first();
                if ($recipe) {
                    foreach ($recipe->ingredients as $ing) {
                        $needed = $ing->qty * $product['qty'];
                        $material = \App\Models\Material::where('name', $ing->name)->first();
                        if (!$material || $material->stock < $needed) {
                            $errors[] = 'Stok bahan "' . $ing->name . '" tidak mencukupi untuk memproses produksi!';
                        }
                    }
                }
            }

            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors)->withInput();
            }
        }

        // 4. Simpan ke Database
        $order = Order::create([
            'customer' => $request->customer,
            'phone' => $request->phone,
            'status' => $request->status,
            'order_date' => $request->order_date,
            'finish_date' => $request->finish_date,
            'notes' => $request->notes,
            'total' => $total,
        ]);

        // Sync to order_product pivot table
        $syncData = [];
        foreach ($request->products as $item) {
            if (isset($item['id'])) {
                $qty = $item['qty'] ?? 1;
                $price = $item['price'] ?? 0;
                $subtotal = $item['subtotal'] ?? ($price * $qty);
                $syncData[$item['id']] = [
                    'qty' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ];
            }
        }
        $order->productsRelation()->sync($syncData);

        // Deduct stock if created directly in "Diproses"
        if ($order->status === 'Diproses') {
            foreach ($request->products as $product) {
                $recipe = \App\Models\Recipe::where('product_name', $product['name'])->first();
                if ($recipe) {
                    foreach ($recipe->ingredients as $ing) {
                        $needed = $ing->qty * $product['qty'];
                        $material = \App\Models\Material::where('name', $ing->name)->first();
                        if ($material) {
                            $material->stock -= $needed;
                            $material->save();

                            \App\Models\MaterialHistory::create([
                                'material_id' => $material->id,
                                'material_name' => $material->name,
                                'type' => 'outbound',
                                'qty' => $needed,
                                'notes' => 'Produksi ' . $product['qty'] . ' unit kue pesanan #' . $order->id,
                                'product_name' => $product['name']
                            ]);
                        }
                    }
                }
            }
        }

        // 5. Lempar balik dengan pesan sukses
        return redirect()->back()->with('success', 'Pesanan baru berhasil dibuat dan disimpan!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi inputan
        $request->validate([
            'customer' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
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
        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Stock deduction check when transitioning to "Diproses"
        if ($oldStatus !== 'Diproses' && $newStatus === 'Diproses') {
            // First check if recipe is complete for all products
            foreach ($request->products as $product) {
                $recipe = \App\Models\Recipe::where('product_name', $product['name'])->first();
                if (!$recipe) {
                    return redirect()->back()->with('error', 'Resep tidak lengkap untuk semua produk dalam pesanan ini');
                }
            }

            // First check if stock is sufficient
            $errors = [];
            foreach ($request->products as $product) {
                $recipe = \App\Models\Recipe::where('product_name', $product['name'])->first();
                if ($recipe) {
                    foreach ($recipe->ingredients as $ing) {
                        $needed = $ing->qty * $product['qty'];
                        $material = \App\Models\Material::where('name', $ing->name)->first();
                        if (!$material || $material->stock < $needed) {
                            $errors[] = 'Stok bahan "' . $ing->name . '" tidak mencukupi untuk memproses produksi!';
                        }
                    }
                }
            }

            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            // Deduct stock and record history
            foreach ($request->products as $product) {
                $recipe = \App\Models\Recipe::where('product_name', $product['name'])->first();
                if ($recipe) {
                    foreach ($recipe->ingredients as $ing) {
                        $needed = $ing->qty * $product['qty'];
                        $material = \App\Models\Material::where('name', $ing->name)->first();
                        if ($material) {
                            $material->stock -= $needed;
                            $material->save();

                            \App\Models\MaterialHistory::create([
                                'material_id' => $material->id,
                                'material_name' => $material->name,
                                'type' => 'outbound',
                                'qty' => $needed,
                                'notes' => 'Produksi ' . $product['qty'] . ' unit kue pesanan #' . $order->id,
                                'product_name' => $product['name']
                            ]);
                        }
                    }
                }
            }
        }

        $order->update([
            'customer' => $request->customer,
            'phone' => $request->phone,
            'status' => $newStatus,
            'order_date' => $request->order_date,
            'finish_date' => $request->finish_date,
            'notes' => $request->notes,
            'total' => $total,
        ]);

        // Sync to order_product pivot table
        $syncData = [];
        foreach ($request->products as $item) {
            if (isset($item['id'])) {
                $qty = $item['qty'] ?? 1;
                $price = $item['price'] ?? 0;
                $subtotal = $item['subtotal'] ?? ($price * $qty);
                $syncData[$item['id']] = [
                    'qty' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ];
            }
        }
        $order->productsRelation()->sync($syncData);

        if ($oldStatus !== 'Selesai' && $newStatus === 'Selesai') {
            return redirect()->back()->with('success', '✅ Pesanan #' . $order->id . ' telah selesai diproduksi!');
        }

        return redirect()->back()->with('success', 'Pesanan berhasil diperbarui!');
    }
}
