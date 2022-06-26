<?php

namespace CommandLibrary\Contract;

use CommandLibrary\Exception\InvalidParamException;

abstract class AbstractCommand
{
    private const FIGURE_BRACKET_PATTERN = '/\s{([\s\S]+?)}/';
    private const FIGURE_BRACKET_PARAMS_PATTERN = '/{([\s\S]+?)}/';
    private const SQUARE_BRACKET_PATTERN = '/\[(.*?)\]/';

    private string $input;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    public function getArgs(): array
    {
        $argsArray = [];
        preg_match_all(self::FIGURE_BRACKET_PATTERN, $this->input, $matches);

        foreach ($matches[1] as $match) {
            $args = explode(', ', $match);
            $argsArray = array_merge($argsArray, $args);
        }

        return $argsArray;
    }

    public function getParams(): array
    {
        $paramsArray = [];
        preg_match_all(self::SQUARE_BRACKET_PATTERN, $this->input, $matches);

        foreach ($matches[1] as $match) {
            $params = explode('=', $match);

            if (!isset($params[1])) {
                echo sprintf('Parameter %1$s is invalid', current($params)) . PHP_EOL;
                continue;
            }

            preg_match(self::FIGURE_BRACKET_PARAMS_PATTERN, $params[1], $valueMatches);
            if (count($valueMatches) !== 0) {
                $params[1] = explode(', ', $valueMatches[1]);
            }

            $paramsArray[current($params)] = $params[1];
        }

        return $paramsArray;
    }

    abstract public static function getHelpInfo(): string;

    abstract public function execute(): void;
}
