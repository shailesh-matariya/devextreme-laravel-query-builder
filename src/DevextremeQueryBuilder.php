<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use ShaileshMatariya\DevextremeQueryBuilder\Exceptions\BadValueException;
use ShaileshMatariya\DevextremeQueryBuilder\Helpers\Column;
use ShaileshMatariya\DevextremeQueryBuilder\Helpers\QueryDataHelper;
use ShaileshMatariya\DevextremeQueryBuilder\Interfaces\CanBeFilter;

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

    /** @var array */
    private $columns;

    /**
     * @var array
     * @TODO only join for the required tables
     */
    private $joins = [];

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model | string $model
     *
     * @return DevextremeQueryBuilder
     * @throws \Exception
     */
    public function model($model): DevextremeQueryBuilder
    {
        if (is_string($model)) {
            $model = new $model;
        }

        if (! $model instanceof CanBeFilter) {
            throw new \Exception('model should be implement CanBeFilter Interface.');
        }

        $this->model = new $model;
        $this->setColumns($model->getColumns());

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
     * add to parameter
     *
     * @param $value
     */
    public function addToParameters($value)
    {
        $this->parameters[] = $value;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * set columns for filter
     *
     * @param $columns array
     *
     * @return DevextremeQueryBuilder
     */
    private function setColumns($columns = []): DevextremeQueryBuilder
    {
        foreach ($columns as $column) {
            if ($column instanceof Column) {
                $this->columns[$column->key] = $column;
            }
        }

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
        return $builder = $this->dataSourceFilter($this->model->newQuery());

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
        $column = $this->validate($expression);

        // convert to query
    }

    /**
     * get Columns for the query filter
     *
     * @param bool $key
     *
     * @return Column|bool|mixed
     */
    private function getColumn($key)
    {
        return $this->columns[$key] ?? false;
    }

    /**
     * validate user input
     *
     * @param $expression
     *
     * @return Column
     */
    private function validate($expression)
    {
        if (! $column = $this->getColumn($expression['field']))
            throw new BadValueException($expression['field'] . ' key is not exists for the filter.');

        $validator = Validator::make($expression, [
            'value' => $column->validator
        ]);

        if ($validator->fails())
            throw new BadValueException('Validation failed for the ' . $expression['field'] . ' in the filter');

        return $column;
    }
}
