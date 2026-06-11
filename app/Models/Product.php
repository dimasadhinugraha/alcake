<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name', 
        'price', 
        'description', 
        'category', 
        'category_id',
        'stock', 
        'status',
        'unit'
    ];

    // Relasi ke User (Author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    // Relasi ke Resep (One-to-Many)
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // Relasi ke Resep (One-to-One)
    public function recipe()
    {
        return $this->hasOne(Recipe::class);
    }

    // Relasi ke Detail Transaksi
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }

    // Relasi ke Order (Many-to-Many via pivot table order_product)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('qty', 'price', 'subtotal')
                    ->withTimestamps();
    }

    // Accessor untuk mendapatkan koleksi model Order yang memuat produk ini
    public function getOrdersAttribute()
    {
        return $this->orders()->get();
    }
}