<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $fillable = ['recipe_id', 'name', 'qty', 'unit'];

    // Relasi ke Resep (Parent)
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    // Relasi ke Bahan Baku (Material)
    public function material()
    {
        return $this->belongsTo(Material::class, 'name', 'name');
    }
}
