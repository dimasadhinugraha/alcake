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
    Schema::create('materials', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('unit'); // kg, pcs, gr, dll
        $table->decimal('stock', 10, 2)->default(0);
        $table->decimal('min_stock', 10, 2)->default(10); // Batas stok rendah
        $table->decimal('max_stock', 10, 2)->nullable();  // Kapasitas gudang
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
