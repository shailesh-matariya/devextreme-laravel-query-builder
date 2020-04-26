<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

class Operator
{
    const NORMAL_OPERATORS = [
        '=', '!=', '<>', '<', '<=', '>', '>='
    ];

    const STRING_OPERATORS = [
        'contains', 'startswith', 'endswith', 'does not contain', 'notcontains'
    ];

    /**
     * get default allowed operators
     * */
    public static function defaultStringOperators(): array
    {
        return array_merge(self::NORMAL_OPERATORS, self::STRING_OPERATORS);
    }
}
