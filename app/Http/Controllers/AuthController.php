<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método de registro
    public function register(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Creación del nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Cifrar la contraseña
        ]);

        // Generar el token de Sanctum para el usuario registrado
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retornar la respuesta con el usuario y su token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Método de login
    public function login(Request $request)
    {
        // Validación de los datos de login
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario con los datos proporcionados
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        // Obtener al usuario autenticado
        $user = Auth::user();

        // Generar un nuevo token para el usuario autenticado
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retornar el token y los detalles del usuario
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
            'user' => $user,
        ]);
    }

    // Cerrar sesión (revocar el token actual)
    public function logout(Request $request)
    {
        // Revocar el token del usuario
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada con éxito'
        ]);
    }
}
