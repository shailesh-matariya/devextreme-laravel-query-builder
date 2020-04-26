<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

use Illuminate\Support\Facades\Facade;

class DevextremeQueryBuilderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'devextreme-query-builder';
    }
}
