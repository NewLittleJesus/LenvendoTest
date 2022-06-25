<?php

namespace App\Command;

use CommandLibrary\Contract\AbstractCommand;

class CommandTwo extends AbstractCommand
{
    public const COMMAND_NAME = 'command_two';

    public static function getHelpInfo(): string
    {
        return 'The command will say \'Hello\'';
    }

    public function execute(): void
    {
        echo 'Hello, Lenvendo' . PHP_EOL;
    }
}
