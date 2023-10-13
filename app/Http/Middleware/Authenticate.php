<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return ($request->is('api/*') || $request->expectsJson()) ? null : route('api/sign-in');
        return $request->expectsJson() ? null : route('login');
    }

    protected function unauthenticated($request, array $guards) {
        // abort(response()->json(['error' => 'Unauthenticated.'], 401));

        if(request()->hasHeader('Authorization') || $request->is('api/*')){
            abort(response()->json(
                [
                    'status' => 'Error',
                    'message' => 'Unauthenticated',
                    'data' => []
                ], 401));
        }
    }
}
