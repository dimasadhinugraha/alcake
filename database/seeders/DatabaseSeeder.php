<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Material;
use App\Models\Product;
use App\Models\Recipe; // Tambahin ini biar bisa manggil tabel resep langsung
use App\Models\RecipeIngredient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin User Admin
        User::create([
            'name' => 'Admin Alva Cake',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // Sesuai request lu
        ]);

        // 2. Bikin Dummy Bahan Baku
        // (Gw tambahin min_stock 0 biar aman kalau di migration lu kolom ini wajib diisi)
        $terigu = Material::create(['name' => 'Tepung Terigu', 'unit' => 'kg', 'stock' => 50, 'min_stock' => 5]);
        $gula = Material::create(['name' => 'Gula Pasir', 'unit' => 'kg', 'stock' => 20, 'min_stock' => 2]);
        $coklat = Material::create(['name' => 'Coklat Bubuk', 'unit' => 'gram', 'stock' => 5000, 'min_stock' => 500]);

        // 3. Bikin Dummy Produk (Kue)
        $brownies = Product::create([
            'name' => 'Brownies Coklat Lumer',
            'price' => 75000
        ]);

        // 4. Bikin Dummy Resep (1 Brownies butuh bahan apa aja?)
        $recipe = Recipe::create([
            'product_name' => 'Brownies Coklat Lumer'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipe->id,
            'name' => 'Tepung Terigu',
            'qty' => 0.5,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipe->id,
            'name' => 'Gula Pasir',
            'qty' => 0.2,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipe->id,
            'name' => 'Coklat Bubuk',
            'qty' => 100,
            'unit' => 'gram'
        ]);
    }
}
