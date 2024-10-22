<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',          // Nombre del producto
        'description',   // Descripción del producto
        'price',         // Precio del producto
        'category_id',   // ID de la categoría
    ];

    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Especifica la clave foránea
    }
}
