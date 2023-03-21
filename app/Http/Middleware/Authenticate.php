<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        abort(
            response()->json([
                'api_status' => '401',
                'message' => 'UnAuthenticated',
            ], 401)
        );
    }
}
