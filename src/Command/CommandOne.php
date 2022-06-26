<?php

namespace App\Command;

use App\Service\CommandResponseService;
use CommandLibrary\Contract\AbstractCommand;
use CommandLibrary\Exception\InvalidParamException;

class CommandOne extends AbstractCommand
{
    public const COMMAND_NAME = 'command_one';

    public static function getHelpInfo(): string
    {
        return 'The command will display command name, parameters and arguments';
    }

    public function execute(): void
    {
        $commandString = 'Command Name: ' . self::COMMAND_NAME . PHP_EOL;

        try {
            if ($this->getParams() !== []) {
                $paramsString = $this->getParamsString($this->getParams());
                $commandString .= 'Parameters: ' . PHP_EOL . $paramsString;
            }
        } catch (InvalidParamException $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }

        if ($this->getArgs() !== []) {
            $argumentsString = $this->getArgumentsString($this->getArgs());
            $commandString .= 'Arguments:' . PHP_EOL . $argumentsString . PHP_EOL;
            if (in_array('help', $this->getArgs())) {
                $commandString .= 'Info: ' . PHP_EOL . self::getHelpInfo() . PHP_EOL;
            }
        }

        echo $commandString;
    }

    private function getParamsString(array $params): string
    {
        $paramsString = '';
        foreach ($params as $key => $param) {
            $paramsString .= CommandResponseService::FOUR_SPACES . '- ';
            $paramsString .= $key . PHP_EOL;
            if (is_string($param)) {
                $param = [$param];
            }
            foreach ($param as $value) {
                $paramsString .= CommandResponseService::EIGHT_SPACES . '- ';
                $paramsString .= $value . PHP_EOL;
            }
        }

        return $paramsString;
    }

    private function getArgumentsString(array $args): string
    {
        $argsString = CommandResponseService::FOUR_SPACES . '- ';
        $argsString .= implode(PHP_EOL . $argsString, $args);

        return $argsString;
    }
}
