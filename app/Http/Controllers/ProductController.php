<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',           // Cambiado de 'nombre' a 'name'
            'description' => 'nullable|string',             // Cambiado de 'descripcion' a 'description'
            'price' => 'required|numeric',                  // Cambiado de 'precio' a 'price'
            'category_id' => 'required|integer|exists:categories,id', // Cambiado de 'categoria_id' a 'category_id'
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    // Ver un producto específico
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Modificar un producto
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',           // Cambiado de 'nombre' a 'name'
            'description' => 'nullable|string',             // Cambiado de 'descripcion' a 'description'
            'price' => 'nullable|numeric',                  // Cambiado de 'precio' a 'price'
            'category_id' => 'nullable|integer|exists:categories,id', // Cambiado de 'categoria_id' a 'category_id'
        ]);

        $product = Product::findOrFail($id);
        $product->update(array_filter($validatedData)); // Solo actualiza los campos que fueron enviados
        return response()->json($product);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204); // 204 No Content
    }
}
