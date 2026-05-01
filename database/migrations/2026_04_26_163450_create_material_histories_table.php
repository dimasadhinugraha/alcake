<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('material_histories', function (Blueprint $table) {
        $table->id();
        // Foreign key ke tabel materials (lebih rapi secara IT)
        $table->foreignId('material_id')->constrained()->onDelete('cascade');
        $table->string('material_name'); // Simpan namanya juga buat cadangan
        $table->enum('type', ['inbound', 'outbound']); // Masuk (+) atau Keluar (-)
        $table->decimal('qty', 10, 2);
        $table->string('notes')->nullable(); // Keterangan (ex: "Beli di pasar")
        $table->string('product_name')->nullable(); // Khusus outbound (kue apa yg dibuat)
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('material_histories');
    }
};