<?php

namespace CommandLibrary\Contract;

use CommandLibrary\Command\CommandOne;
use CommandLibrary\Command\CommandTwo;

interface CommandListInterface
{
    public const COMMAND_LIST = [
        CommandOne::COMMAND_NAME => CommandOne::class,
        CommandTwo::COMMAND_NAME => CommandTwo::class,
    ];
}
