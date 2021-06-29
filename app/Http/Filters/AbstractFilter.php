<?php namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    protected $request;
    protected $builder;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function filter(Builder $builder)
    {
        foreach($this->getFilters() as $filter => $value)
        {
            $this->resolveFilter($filter)->filter($builder, $value);
        }
        $this->setBuilder($builder);
        return $this;
    }

    protected function setBuilder($builder)
    {
        $this->builder = $builder;
    }
    protected function getFilters()
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }

    public function orderBy($sortBy,$direction)
    {
        return $this->builder->orderBy($sortBy,$direction);
    }
    public function sort()
    {
        $sortBy = $this->request->input('sortBy', 'id');
        $direction = $this->request->input('direction', 'DESC');
        $this->builder->orderBy($sortBy,$direction);
        return $this;
    }
    public function where($field, $arg)
    {
        return $this->builder->where($field, $arg);
    }
    public function with($arg)
    {
        $this->builder->with($arg);
        return $this;
    }
    public function join($table, $alias, $operation, $aliasJoin)
    {
        return $this->builder->join($table, $alias, $operation, $aliasJoin);
    }
    public function leftJoin($table, $alias, $operation, $aliasJoin)
    {
        return $this->builder->leftJoin($table, $alias, $operation, $aliasJoin);
    }
    public function paginate()
    {
        return $this->builder->paginate( 
            $this->request->input(
                'per_page',
                config('sede.items_per_page')
            )
        );
    }
    public function first()
    {
        return $this->builder->first();
    }
    public function get()
    {
        return $this->builder->get();
    }
    public function count()
    {
        return $this->builder->count();
    }

}