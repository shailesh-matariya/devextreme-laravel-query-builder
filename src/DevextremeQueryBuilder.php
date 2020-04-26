<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use ShaileshMatariya\DevextremeQueryBuilder\Helpers\QueryDataHelper;

class DevextremeQueryBuilder
{
    /** @var Model */
    private $model;

    /** @var array */
    public $filter;

    /** @var string */
    protected $query;

    /** @var string */
    public $parameters;

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     *
     * @return DevextremeQueryBuilder
     */
    public function model(Model $model): DevextremeQueryBuilder
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param array $filter
     *
     * @return DevextremeQueryBuilder
     */
    public function filter(array $filter): DevextremeQueryBuilder
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * DataSource filter
     *
     * @param Builder $builder
     * @param $expression
     *
     * @return Builder
     * @throws \Exception
     */
    private function dataSourceFilter(Builder $builder): Builder
    {
        if (empty($this->filter)) {
            return $builder;
        }

        if (is_string($this->filter)) {
            $this->filter = json_decode($this->filter, true);
        }

        $query = $this->dataSourceParser($this->filter);

        return $builder->whereRaw($query->getQuery(), $query->getParameters());
    }

    /**
     * get the result
     *
     * @throws \Exception
     */
    public function get()
    {
        // Parse the filter
        $builder = $this->dataSourceFilter($this->model->newQuery());

        // returns output
    }

    /**
     * parse query from the json input
     *
     * @param array $expression
     *
     * @return QueryDataHelper
     */
    public function dataSourceParser($expression): QueryDataHelper
    {
        $prevItemWasAnArray = false;
        foreach ($expression as $index => $item) {
            if (is_string($item)) {
                $prevItemWasAnArray = false;
                if ($index == 0) {
                    if (isset($expression) && is_array($expression)) {
                        $itemsCount = count($expression);

                        if ($itemsCount == 2) {
                            $rule = [
                                'field' => $expression[0],
                                'operator' => '=',
                                'value' => $expression[1]
                            ];
                        } else {
                            $rule = [
                                'field' => $expression[0],
                                'operator' => $expression[1],
                                'value' => $expression[2]
                            ];
                        }

                        $this->singleExpressionToQuery($rule);
                    }
                    break;
                }
                $condition = strtoupper(trim($item));
                if ($condition == 'AND' || $condition == 'OR') {
                    $this->query .= " " . $condition . " ";
                }
                continue;
            }
            if (is_array($item)) {
                if ($prevItemWasAnArray) {
                    $this->query .= " AND ";
                }
                $this->query .= '(';
                $this->dataSourceParser($item);
                $this->query .= ')';

                $prevItemWasAnArray = true;
            }
        }

        return new QueryDataHelper($this->query, $this->parameters);
    }

    /**
     * convert expression to simple query
     *
     * @param $expression
     */
    private function singleExpressionToQuery($expression)
    {
        // check validations

        // convert to query
    }
}
