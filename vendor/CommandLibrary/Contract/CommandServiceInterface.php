<?php

namespace CommandLibrary\Contract;

use CommandLibrary\Contract\AbstractCommand;

interface CommandServiceInterface
{
    public function getCommand(string $input): AbstractCommand;

    public function getCommandListWithInfo(): array;

    public function setCommandList(array $commandList): void;
}
