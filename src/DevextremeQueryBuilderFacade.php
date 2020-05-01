<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static DevextremeQueryBuilder model(Model|string $model)
 * */
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
