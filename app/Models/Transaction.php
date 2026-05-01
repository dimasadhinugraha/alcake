<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['customer', 'admin', 'type', 'status', 'paid', 'total', 'payment_date', 'dp_nota', 'products'];

    protected $casts = [
        'products' => 'array', // Biar otomatis jadi array di PHP
    ];
}
