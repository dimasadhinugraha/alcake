<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer', 'phone', 'status', 'order_date', 'finish_date', 'notes', 'total'];

    protected $casts = [];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    // Relasi ke Product (Many-to-Many via pivot table order_product)
    public function productsRelation()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('qty', 'price', 'subtotal')
                    ->withTimestamps();
    }

    // Accessor untuk mendapatkan koleksi model Product yang dibeli dalam order ini
    public function getProductModelsAttribute()
    {
        return $this->productsRelation;
    }

    // Accessor untuk mensimulasikan kolom JSON products yang lama secara dinamis dari tabel pivot
    public function getProductsAttribute()
    {
        return $this->productsRelation->map(function ($product) {
            return [
                'id' => $product->id,
                'qty' => $product->pivot->qty,
                'name' => $product->name,
                'price' => (float) $product->pivot->price,
                'subtotal' => (float) $product->pivot->subtotal,
            ];
        })->toArray();
    }
}