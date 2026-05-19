<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['product_name'];

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
}
