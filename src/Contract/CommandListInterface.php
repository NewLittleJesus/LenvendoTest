<?php

namespace App\Contract;

use App\Command\CommandOne;
use App\Command\CommandTwo;

interface CommandListInterface
{
    public const COMMAND_LIST = [
        CommandOne::COMMAND_NAME => CommandOne::class,
        CommandTwo::COMMAND_NAME => CommandTwo::class,
    ];
}