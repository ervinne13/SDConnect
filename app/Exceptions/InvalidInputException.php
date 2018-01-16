<?php

namespace App\Exceptions;

use \Exception;

class InvalidInputException extends Exception implements HttpCodeProviderException
{
    const HTTP_CODE = 401;

    public function getHttpResponseCode()
    {
        return static::HTTP_CODE;
    }
}