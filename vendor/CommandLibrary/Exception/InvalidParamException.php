<?php

namespace CommandLibrary\Exception;

use Exception;
use Throwable;

class InvalidParamException extends Exception
{
    public function __construct(string $parameter)
    {
        $message = sprintf('Parameter %1$s is invalid', $parameter);
        parent::__construct($message, $code = 0, $previous = null);
    }
}
