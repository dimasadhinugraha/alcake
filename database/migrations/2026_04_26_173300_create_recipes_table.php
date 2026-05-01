<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            // Tiga kolom sakti biar seeder lu nggak error lagi
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('quantity_needed', 10, 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
