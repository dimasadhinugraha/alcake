<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'stock',
        'min_stock',
        'max_stock'
    ];

    // Auto generate formatted material ID (Bahan Baku)
    public function getFormattedIdAttribute()
    {
        return sprintf('BAH-%04d', $this->id);
    }
}