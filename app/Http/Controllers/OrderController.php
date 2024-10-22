<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Listar todos los pedidos
    public function index()
    {
        // Carga los datos relacionados con el usuario y el producto
        $orders = Order::with(['user', 'product'])->get();
        return response()->json($orders);
    }

    // Crear un nuevo pedido
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',        // Cambiado de 'usuario_id' a 'user_id'
            'product_id' => 'required|integer|exists:products,id',  // Cambiado de 'producto_id' a 'product_id'
            'quantity' => 'required|integer|min:1',                 // Cambiado de 'cantidad' a 'quantity'
            'status' => 'nullable|in:pending,completed,canceled',   // Cambiado de 'estado' a 'status'
        ]);

        $order = Order::create($validatedData);
        return response()->json($order, 201);
    }

    // Ver un pedido específico
    public function show($id)
    {
        $order = Order::with(['user', 'product'])->findOrFail($id);
        return response()->json($order);
    }

    // Modificar un pedido
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',        // Cambiado de 'usuario_id' a 'user_id'
            'product_id' => 'nullable|integer|exists:products,id',  // Cambiado de 'producto_id' a 'product_id'
            'quantity' => 'nullable|integer|min:1',                 // Cambiado de 'cantidad' a 'quantity'
            'status' => 'nullable|in:pending,completed,canceled',   // Cambiado de 'estado' a 'status'
        ]);

        $order = Order::findOrFail($id);
        $order->update(array_filter($validatedData)); // Solo actualiza los campos que fueron enviados
        return response()->json($order);
    }

    // Eliminar un pedido
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204); // 204 No Content
    }
}
