<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar todas las categorías
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Crear una nueva categoría
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Cambiado de 'nombre' a 'name'
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    // Ver una categoría específica
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    // Modificar una categoría
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255', // Cambiado de 'nombre' a 'name'
        ]);

        $category = Category::findOrFail($id);
        $category->update(array_filter($validatedData)); // Solo actualiza los campos que fueron enviados
        return response()->json($category);
    }

    // Eliminar una categoría
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204); // 204 No Content
    }
}
