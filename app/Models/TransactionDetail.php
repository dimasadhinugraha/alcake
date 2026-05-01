<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    // Daftarkan kolom yang boleh diisi secara otomatis
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'subtotal'
    ];

    // Relasi balik ke Produk (Kue)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
