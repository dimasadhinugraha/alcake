<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer'); // Nama pelanggan
        $table->string('status'); // Pending, Diproses, Selesai
        $table->date('order_date'); // Tanggal pemesanan
        $table->date('finish_date')->nullable(); // Estimasi selesai
        $table->text('notes')->nullable(); // Catatan tambahan
        $table->decimal('total', 12, 2)->default(0); // Total harga
        $table->json('products'); // Simpan keranjang belanja (JSON)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};