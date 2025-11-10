<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SaleDetail;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales'; // ✅ nombre estándar en inglés

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_document',
        'total',
    ];

    // Relación: una venta pertenece a un usuario (vendedor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una venta tiene muchos detalles (productos vendidos)
    public function details()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }
}

