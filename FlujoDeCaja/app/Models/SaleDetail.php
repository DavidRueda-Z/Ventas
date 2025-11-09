<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'sale_details';

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    // Relación: un detalle pertenece a una venta
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relación: un detalle pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

