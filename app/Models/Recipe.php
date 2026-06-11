<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['product_id'];

    // Auto generate formatted recipe ID
    public function getFormattedIdAttribute()
    {
        return sprintf('RSP-%04d', $this->id);
    }

    // Relasi: Satu resep punya banyak bahan
    public function ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    // Relasi: Banyak resep terhubung ke banyak bahan (Material)
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'recipe_ingredients', 'recipe_id', 'name', 'id', 'name')
                    ->withPivot('qty', 'unit')
                    ->withTimestamps();
    }

    // Relasi ke Product (Kue)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor dinamis untuk mensimulasikan product_name
    public function getProductNameAttribute()
    {
        return $this->product ? $this->product->name : null;
    }
}
