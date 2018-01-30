<?php

namespace App\Exceptions\Http;

use App\Exceptions\HttpCodeProviderException;
use \Exception;

class AccessDeniedException extends Exception implements HttpCodeProviderException
{
    const HTTP_CODE = 403;

    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $message = $message ? $message : 'Access Denied';
        parent::__construct($message, $code, $previous);
    }

    public function getHttpResponseCode()
    {
        return static::HTTP_CODE;
    }    
}