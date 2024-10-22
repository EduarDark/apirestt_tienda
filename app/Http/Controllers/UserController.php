<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Método para listar todos los usuarios
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
}
