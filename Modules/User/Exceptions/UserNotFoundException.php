<?php

namespace Modules\User\Exceptions;

use Exception;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotFoundException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return response()->json(['status' => 'fail'], 404);
    }
}
