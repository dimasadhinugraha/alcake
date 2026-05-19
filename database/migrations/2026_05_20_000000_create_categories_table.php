<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // 2. Seed initial categories
        $categories = ['Lapis Legit', 'Black Forest', 'Brownies', 'Bolu Jadoel', 'Dessert Box'];
        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name' => $cat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Add category_id to products table
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')->constrained('categories')->onDelete('set null');
        });

        // 4. Migrate existing string categories to category_id
        $products = DB::table('products')->get();
        foreach ($products as $prod) {
            if (!empty($prod->category)) {
                $category = DB::table('categories')->where('name', 'like', $prod->category)->first();
                if (!$category) {
                    // If not found in initial categories, insert it
                    $catId = DB::table('categories')->insertGetId([
                        'name' => $prod->category,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $catId = $category->id;
                }
                
                DB::table('products')->where('id', $prod->id)->update([
                    'category_id' => $catId,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('categories');
    }
};
