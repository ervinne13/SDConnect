<?php

namespace App\Exceptions;

interface HttpCodeProviderException
{
    public function getHttpResponseCode();
}