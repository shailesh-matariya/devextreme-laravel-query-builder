<?php

namespace ShaileshMatariya\DevextremeQueryBuilder\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait QueryBuilderTrait
{


    /**
     * DataSource filter
     *
     * @param Builder $builder
     * @param $expression
     *
     * @return Builder
     */
    public function scopeDataSourceFilter(Builder $builder, $expression)
    {
        if (empty($expression)) {
            return $builder;
        }

        if (is_string($expression)) {
            $expression = json_decode($expression, true);
        }

        $query = $this->getOverviewInstance()->dataSourceParser($expression);

        return $builder->whereRaw($query->getQuery(), $query->getParameters());
    }
}
