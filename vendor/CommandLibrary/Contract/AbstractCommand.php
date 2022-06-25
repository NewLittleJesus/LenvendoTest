<?php

namespace CommandLibrary\Contract;

abstract class AbstractCommand
{
    private const FIGURE_BRACKET_PATTERN = '/{([\s\S]+?)}/';
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
        preg_replace(self::FIGURE_BRACKET_PATTERN, '', $this->input); //мб можно вырезать в одно действие

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
        preg_replace(self::SQUARE_BRACKET_PATTERN, '', $this->input); // здесь тоже

        foreach ($matches[1] as $match) {
            $params = explode('=', $match);
            $paramValue = [$params[1]];

            preg_match(self::FIGURE_BRACKET_PATTERN, $this->input, $valueMatches);
            if (count($valueMatches) !== 0) {
                $paramValue = explode(', ', $valueMatches[1]);
            }

            $paramsArray[current($params)] = $paramValue;
        }

        return $paramsArray;
    }

    abstract public static function getHelpInfo(): string;
}
