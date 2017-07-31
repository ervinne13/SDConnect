<?php

namespace App\Modules\Base\Exceptions;

use Exception;

/**
 * Description of NotYetImplementedException
 *
 * @author ervinne
 */
class NotYetImplementedException extends Exception
{

    public function __construct(string $message = "This functionality is not yet implemented", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
