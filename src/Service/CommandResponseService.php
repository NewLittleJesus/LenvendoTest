<?php

namespace App\Service;

use App\Contract\CommandListInterface;
use CommandLibrary\Contract\CommandServiceInterface;

class CommandResponseService
{
    public const TWELVE_SPACES = '            ';
    public const EIGHT_SPACES = '        ';
    public const FOUR_SPACES = '    ';

    private CommandServiceInterface $commandService;

    public function __construct(CommandServiceInterface $commandService)
    {
        $this->commandService = $commandService;
        $this->commandService->setCommandList(CommandListInterface::COMMAND_LIST);
    }

    public function getResponse(string $input): void
    {
        $input = str_replace(PHP_EOL, '', $input);

        if ($input === '') {
            $this->getList();
        } else {
            $this->getStructure($input);
        }
    }

    private function getList(): void
    {
        $list = self::FOUR_SPACES . 'name' . self::TWELVE_SPACES . 'info' . PHP_EOL;
        $commandList = $this->commandService->getCommandListWithInfo();

        foreach ($commandList as $commandName => $commandInfo) {
            $list .= $commandName . self::EIGHT_SPACES . $commandInfo . PHP_EOL;
        }

        echo $list;
    }

    private function getStructure(string $input): void
    {
        $command = $this->commandService->getCommand($input);
        $command->execute();
    }
}
