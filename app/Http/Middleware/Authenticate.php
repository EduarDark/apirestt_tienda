<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // En lugar de redirigir, devuelves un error 401 en formato JSON
        if (!$request->expectsJson()) {
            abort(response()->json(['message' => 'Unauthorized.'], 401));
        }
    }

}
