<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        // Migrate existing order products JSON to pivot table
        $orders = DB::table('orders')->get();
        foreach ($orders as $order) {
            $products = json_decode($order->products, true);
            if (is_array($products)) {
                foreach ($products as $p) {
                    $productId = $p['id'] ?? null;
                    if (!$productId && isset($p['name'])) {
                        // Fallback: search product by name if ID was somehow not recorded
                        $product = DB::table('products')->where('name', $p['name'])->first();
                        if ($product) {
                            $productId = $product->id;
                        }
                    }
                    if ($productId) {
                        $qty = $p['qty'] ?? 1;
                        $price = $p['price'] ?? 0;
                        $subtotal = $p['subtotal'] ?? ($price * $qty);
                        DB::table('order_product')->insert([
                            'order_id' => $order->id,
                            'product_id' => $productId,
                            'qty' => $qty,
                            'price' => $price,
                            'subtotal' => $subtotal,
                            'created_at' => $order->created_at,
                            'updated_at' => $order->updated_at,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
