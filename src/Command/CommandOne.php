<?php

namespace App\Command;

use App\Service\CommandResponseService;
use CommandLibrary\Contract\AbstractCommand;

class CommandOne extends AbstractCommand
{
    public const COMMAND_NAME = 'command_one';

    public static function getHelpInfo(): string
    {
        return 'The command will display command name, parameters and arguments';
    }

    public function execute(): void
    {
        $argsAndParams = $this->getArgsAndParams();

        $commandString = 'Command Name: ' . self::COMMAND_NAME . PHP_EOL;

        if ($argsAndParams[AbstractCommand::PARAMETERS_KEY] !== []) {
            $paramsString = $this->getParamsString($argsAndParams[AbstractCommand::PARAMETERS_KEY]);
            $commandString .= 'Parameters: ' . PHP_EOL . $paramsString;
        }

        if ($argsAndParams[AbstractCommand::ARGUMENTS_KEY] !== []) {
            $argumentsString = $this->getArgumentsString($argsAndParams[AbstractCommand::ARGUMENTS_KEY]);
            $commandString .= 'Arguments:' . PHP_EOL . $argumentsString . PHP_EOL;
            if (in_array('help', $argsAndParams[AbstractCommand::ARGUMENTS_KEY])) {
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
