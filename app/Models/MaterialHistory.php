<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialHistory extends Model
{
    use HasFactory;

    // Tambahin material_id di sini biar nggak di-blokir!
    protected $fillable = [
        'material_id',
        'material_name',
        'type',
        'qty',
        'notes',
        'product_name',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
