<?php

namespace ShaileshMatariya\DevextremeQueryBuilder\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use ShaileshMatariya\DevextremeQueryBuilder\Facades\Column;
use ShaileshMatariya\DevextremeQueryBuilder\Interfaces\CanBeFilter;

class DummyModel extends Model implements CanBeFilter
{

    /**
     * @inheritDoc
     */
    public function getColumns()
    {
        return [
            Column::key('first_name1'),
            Column::key('location_id')
        ];
    }
}
