<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer', 'status', 'order_date', 'finish_date', 'notes', 'total', 'products'];

    protected $casts = [
        'products' => 'array', // Biar data keranjang otomatis jadi Array
    ];
}