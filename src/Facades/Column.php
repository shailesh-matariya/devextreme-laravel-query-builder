<?php

namespace ShaileshMatariya\DevextremeQueryBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column key(string $string)
 * @method static \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column queryKey(string $string)
 * @method static \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column aliasKey(string $string)
 * @method static \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column validator(string $string)
 * @method static \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column table(string $string)
 * @method static \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column tableAlias(string $string)
 **/
class Column extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return new \ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column();
    }
}
