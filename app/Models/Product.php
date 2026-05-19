<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'price', 
        'description', 
        'category', 
        'category_id',
        'stock', 
        'status'
    ];

    // Relasi ke Kategori
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Auto generate formatted product ID
    public function getFormattedIdAttribute()
    {
        return sprintf('PRD-%04d', $this->id);
    }

    // Relasi ke Resep
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // Relasi ke Detail Transaksi
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }
}