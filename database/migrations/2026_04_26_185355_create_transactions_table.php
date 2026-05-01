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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->string('customer');
        $table->string('admin')->default('Admin Alva Cake');
        $table->enum('type', ['Lunas', 'DP']);
        $table->enum('status', ['Lunas', 'Belum Lunas']);
        $table->decimal('paid', 12, 2); // Total yang udah dibayar
        $table->decimal('total', 12, 2); // Total keseluruhan pesanan
        $table->date('payment_date'); // Tanggal pembayaran
        $table->string('dp_nota')->nullable(); // Opsional, nomor nota
        $table->json('products')->nullable(); // Simpan rincian produk format JSON biar praktis
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};