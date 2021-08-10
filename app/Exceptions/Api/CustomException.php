<?php

namespace App\Exceptions\Api;

use Exception;

abstract class CustomException extends Exception
{
    protected $code = 500;

    protected $message = 'Something went wrong';

    protected $errors = [];

    public function render()
    {
        return response([
            'message' => $this->message,
            'errors' => $this->errors
        ], $this->code);
    }

    public function withCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function withMessage($message)
    {
        $this->message = __($message);
        return $this;
    }
}
