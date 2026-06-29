<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Material; // Ambil dari tabel bahan baku asli
use App\Models\Product; // Ambil dari katalog produk kue
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        // 1. Tarik semua resep dari database beserta bahan-bahannya
        $recipes = Recipe::with('ingredients', 'product')->get();

        // 2. Ambil list Produk Kue untuk dropdown, kecualikan yang sudah punya resep master
        $existingProductIds = Recipe::pluck('product_id')->toArray();

        $availableProducts = Product::orderBy('name')
            ->whereNotIn('id', $existingProductIds)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                ];
            })
            ->values();

        // 3. Ambil list Bahan Baku asli dari database materials lu
        $availableMaterials = Material::all();

        return view('recipes.index', compact('recipes', 'availableProducts', 'availableMaterials'));
    }

    // SIMPAN RESEP BARU
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|unique:recipes,product_id',
            'ingredients' => 'required|array|min:1', // Wajib ada minimal 1 bahan
        ], [
            'product_id.unique' => 'Resep untuk kue ini sudah ada!',
            'ingredients.required' => 'Minimal harus ada 1 bahan baku!'
        ]);

        // 1. Simpan nama resep (Kue)
        $recipe = Recipe::create([
            'product_id' => $request->product_id
        ]);

        // 2. Looping array ingredients dari JS, lalu simpan ke database
        foreach ($request->ingredients as $item) {
            RecipeIngredient::create([
                'recipe_id' => $recipe->id,
                'name' => $item['name'],
                'qty' => $item['qty'],
                'unit' => $item['unit']
            ]);
        }

        return redirect()->back()->with('success', 'Resep baru berhasil disimpan ke Database!');
    }

    // UPDATE RESEP (Hapus bahan lama, masukin bahan baru)
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|integer|unique:recipes,product_id,'.$id,
            'ingredients' => 'required|array|min:1',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update(['product_id' => $request->product_id]);

        // Cara paling gampang update relasi One-to-Many:
        // Hapus semua bahan lama milik resep ini, lalu masukin yang baru dari form
        $recipe->ingredients()->delete();

        foreach ($request->ingredients as $item) {
            RecipeIngredient::create([
                'recipe_id' => $recipe->id,
                'name' => $item['name'],
                'qty' => $item['qty'],
                'unit' => $item['unit']
            ]);
        }

        return redirect()->back()->with('success', 'Resep berhasil diperbarui di Database!');
    }

    // HAPUS RESEP
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->ingredients()->delete();
        $recipe->delete();

        return redirect()->back()->with('success', 'Resep berhasil dihapus dari Database!');
    }
}
