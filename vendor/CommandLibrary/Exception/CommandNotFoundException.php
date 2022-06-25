<?php

namespace CommandLibrary\Exception;

use Exception;

class CommandNotFoundException extends Exception
{
    public function __construct(string $commandName)
    {
        $message = sprintf('Command %1$s not found', $commandName);
        parent::__construct($message, $code = 0, $previous= null);
    }
}
