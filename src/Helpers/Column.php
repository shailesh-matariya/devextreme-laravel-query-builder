<?php


namespace ShaileshMatariya\DevextremeQueryBuilder\Helpers;


class Column
{
    public $key;
    public $queryKey;
    public $aliasKey;

    public $operator;
    public $validator;

    public $table;
    public $tableAlias;

    public function __construct($column)
    {
        // @TODO key must be set
        // @TODO rest of optional
    }
}
