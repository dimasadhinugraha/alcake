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
        // 1. Add product_id column
        Schema::table('recipes', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->after('id')->constrained('products')->onDelete('cascade');
        });

        // 2. Map existing data
        $recipes = DB::table('recipes')->get();
        foreach ($recipes as $r) {
            $product = DB::table('products')->where('name', $r->product_name)->first();
            if ($product) {
                DB::table('recipes')->where('id', $r->id)->update(['product_id' => $product->id]);
            }
        }

        // 3. Drop product_name and make product_id non-nullable & unique
        Schema::table('recipes', function (Blueprint $table) {
            if (DB::getDriverName() === 'sqlite') {
                $table->dropUnique('recipes_product_name_unique');
            } else {
                $table->dropUnique(['product_name']);
            }
            $table->dropColumn('product_name');
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable(false)->change()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('product_name')->nullable()->after('id');
        });

        // Map back
        $recipes = DB::table('recipes')->get();
        foreach ($recipes as $r) {
            $product = DB::table('products')->where('id', $r->product_id)->first();
            if ($product) {
                DB::table('recipes')->where('id', $r->id)->update(['product_name' => $product->name]);
            }
        }

        Schema::table('recipes', function (Blueprint $table) {
            $table->string('product_name')->nullable(false)->change()->unique();
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
