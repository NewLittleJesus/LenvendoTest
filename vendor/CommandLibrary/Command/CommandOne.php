<?php

namespace CommandLibrary\Command;

use CommandLibrary\Contract\AbstractCommand;

class CommandOne extends AbstractCommand
{
    public const COMMAND_NAME = 'command_one';

    public static function getHelpInfo(): string
    {
        return 'Help info for command 1';
    }
}
