<?php

namespace App\Exceptions\Api\Auth;

use Exception;
use App\Exceptions\Api\CustomException;

class InvalidCredentailsException extends CustomException
{
    protected $code = 401;

    protected $message = 'Invalid credentails';

    protected $errors = [];
}
