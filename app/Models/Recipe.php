<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['product_name'];

    // Relasi: Satu resep punya banyak bahan
    public function ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}
