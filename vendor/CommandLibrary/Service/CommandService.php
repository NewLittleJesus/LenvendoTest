<?php

namespace CommandLibrary\Service;

use CommandLibrary\Contract\AbstractCommand;
use CommandLibrary\Contract\CommandServiceInterface;
use CommandLibrary\Exception\CommandNotFoundException;

class CommandService implements CommandServiceInterface
{
    public array $commandList = [];

    public function getCommand(string $input): AbstractCommand
    {
        $inputCommandName = $this->getCommandName($input);
        foreach ($this->commandList as $commandName => $commandClass) {
            if ($inputCommandName !== $commandName) {
                continue;
            }

            return new $commandClass($input);
        }

        throw new CommandNotFoundException($inputCommandName);
    }

    public function setCommandList(array $commandList): void
    {
        $this->commandList = $commandList;
    }

    public function getCommandListWithInfo(): array
    {
        $commands = [];
        foreach ($this->commandList as $commandName => $commandClass) {
            $commands[$commandName] = $commandClass::getHelpInfo();
        }

        return $commands;
    }

    private function getCommandName(string $input): string
    {
        if (strpos($input, ' ')) {
            return strstr($input, ' ', true);
        }

        return $input;
    }
}
