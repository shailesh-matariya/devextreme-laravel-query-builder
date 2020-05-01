<?php


namespace ShaileshMatariya\DevextremeQueryBuilder\Helpers;

use ShaileshMatariya\DevextremeQueryBuilder\Exceptions\BadValueException;

class Column
{
    public $key;
    public $queryKey;
    public $aliasKey;

    public $validator;

    public $table;
    public $tableAlias;

    /**
     * @param $key
     *
     * @return $this
     */
    public function key($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @param $queryKey
     *
     * @return $this
     */
    public function queryKey($queryKey)
    {
        $this->queryKey = $queryKey;

        return $this;
    }

    /**
     * @param $aliasKey
     *
     * @return $this
     */
    public function aliasKey($aliasKey)
    {
        $this->aliasKey = $aliasKey;

        return $this;
    }

    /**
     * @param $validator
     *
     * @return $this
     */
    public function validator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @param $table
     *
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param $tableAlias
     *
     * @return $this
     */
    public function tableAlias($tableAlias)
    {
        $this->tableAlias = $tableAlias;

        return $this;
    }
}
