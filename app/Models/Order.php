<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      // ID del usuario que realizó el pedido
        'product_id',   // ID del producto
        'quantity',     // Cantidad de productos
        'status',       // Estado del pedido
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
