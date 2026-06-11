<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['order_id', 'customer', 'admin', 'type', 'status', 'paid', 'total', 'payment_date', 'dp_nota', 'settlement_nota', 'notes'];

    protected $casts = [];
    protected $appends = ['products'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Accessor untuk mensimulasikan kolom JSON products secara dinamis dari relasi Order
    public function getProductsAttribute()
    {
        return $this->order ? $this->order->products : [];
    }
}
