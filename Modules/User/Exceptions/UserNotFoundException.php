<?php

namespace Modules\User\Exceptions;

use Exception;
class UserNotFoundException extends \Exception
{
    public function render()
    {
        return response()->json([], 404);
    }
}
