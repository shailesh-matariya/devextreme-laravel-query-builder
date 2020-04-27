<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

class Operator
{
    private const NORMAL_OPERATORS = [
        '=', '!=', '<>', '<', '<=', '>', '>=',
    ];

    private const STRING_OPERATORS = [
        'contains', 'startswith', 'endswith', 'does not contain', 'notcontains'
    ];

    private const ARRAY_OPERATORS = [
        'in', 'not in'
    ];

    /** @var array */
    private $specialOperators = [];

    /**
     * get default allowed operators
     * */
    public static function defaultStringOperators(): array
    {
        return array_merge(self::NORMAL_OPERATORS, self::STRING_OPERATORS);
    }

    /**
     * get default integer operators
     * */
    public static function defaultIntegerOperator(): array
    {
        return self::NORMAL_OPERATORS;
    }

    /**
     * get default array operators
     * */
    public static function defaultArrayOperator(): array
    {
        return self::ARRAY_OPERATORS;
    }
}
