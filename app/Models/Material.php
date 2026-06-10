<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'stock',
        'min_stock',
        'max_stock'
    ];

    // Auto generate formatted material ID (Bahan Baku)
    public function getFormattedIdAttribute()
    {
        return sprintf('BAH-%04d', $this->id);
    }

    // Relasi ke RecipeIngredient
    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class, 'name', 'name');
    }

    // Relasi: Banyak bahan baku (Material) terhubung ke banyak Resep (Recipe)
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'name', 'recipe_id', 'name', 'id')
                    ->withPivot('qty', 'unit')
                    ->withTimestamps();
    }
}