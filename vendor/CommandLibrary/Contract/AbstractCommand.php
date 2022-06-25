<?php

namespace CommandLibrary\Contract;

abstract class AbstractCommand
{
    private const FIGURE_BRACKET_PATTERN = '/\s{([\s\S]+?)}/';
    private const FIGURE_BRACKET_PARAMS_PATTERN = '/{([\s\S]+?)}/';
    private const SQUARE_BRACKET_PATTERN = '/\[(.*?)\]/';
    public const PARAMETERS_KEY = 'parameters';
    public const ARGUMENTS_KEY = 'args';

    private string $input;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    public function getArgsAndParams(): array
    {
        $argsAndParams = [];
        $argsAndParams[self::PARAMETERS_KEY] = $this->getParams();
        $argsAndParams[self::ARGUMENTS_KEY] = $this->getArgs();

        return $argsAndParams;
    }

    private function getArgs(): array
    {
        $argsArray = [];
        preg_match_all(self::FIGURE_BRACKET_PATTERN, $this->input, $matches);

        foreach ($matches[1] as $match) {
            $args = explode(', ', $match);
            $argsArray = array_merge($argsArray, $args);
        }

        return $argsArray;
    }

    private function getParams(): array
    {
        $paramsArray = [];
        preg_match_all(self::SQUARE_BRACKET_PATTERN, $this->input, $matches);

        foreach ($matches[1] as $match) {
            $params = explode('=', $match);
            $paramValue = $params[1];

            preg_match(self::FIGURE_BRACKET_PARAMS_PATTERN, $paramValue, $valueMatches);
            if (count($valueMatches) !== 0) {
                $paramValue = explode(', ', $valueMatches[1]);
            }

            $paramsArray[current($params)] = $paramValue;
        }

        return $paramsArray;
    }

    abstract public static function getHelpInfo(): string;

    abstract public function execute(): void;
}
