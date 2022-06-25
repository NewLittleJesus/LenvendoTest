<?php

namespace CommandLibrary\Command;

use CommandLibrary\Contract\AbstractCommand;

class CommandTwo extends AbstractCommand
{
    public const COMMAND_NAME = 'command_two';

    public static function getHelpInfo(): string
    {
        return 'Help info for command 2';
    }
}
