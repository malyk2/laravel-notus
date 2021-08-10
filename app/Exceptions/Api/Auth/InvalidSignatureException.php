<?php

namespace App\Exceptions\Api\Auth;

use App\Exceptions\Api\CustomException;

class InvalidSignatureException extends CustomException
{
    protected $code = 401;

    protected $message = 'Wrong link';

    protected $errors = [];
}
