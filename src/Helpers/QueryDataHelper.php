<?php

namespace ShaileshMatariya\DevextremeQueryBuilder\Helpers;

class QueryDataHelper
{
    /** @var string */
    public $query;

    /** @var string */
    public $parameters;

    public function __construct($query, $parameters)
    {
        $this->query = $query;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getParameters(): string
    {
        return $this->parameters;
    }

}
