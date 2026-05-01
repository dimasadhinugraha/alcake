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
        'stock', 
        'status'
    ];

    // Relasi ke Resep (Mungkin sudah ada)
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // TAMBAHKAN RELASI INI 👇
    // Relasi ke Detail Transaksi (Untuk mengetahui produk ini terjual berapa banyak)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }
}