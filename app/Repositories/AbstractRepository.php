<?php namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * The Abstract Repository provides default implementations of the methods defined
 * in the base repository interface. These simply delegate static function calls 
 * to the right eloquent model based on the $modelClassName.
 */

abstract class AbstractRepository implements RepositoryInterface {
    
    protected $modelClassName;
    protected $modelClassNamePath;
    protected $collectionNamePath;
    protected $resourceNamePath;

    //wiki
    public function find($id)
    {
        return call_user_func_array("{$this->modelClassNamePath}::find", array($id));
    }
    public function create(array $attributes, $extraInfo = [])
    {
        return $this->getOne(
            call_user_func_array(
                "{$this->modelClassNamePath}::create", array($attributes)
            ), $extraInfo
        );
    }
    public function destroy($ids)
    {
        return call_user_func_array("{$this->modelClassNamePath}::destroy", array($ids));
    }
    //custom

    public function all($request)
    {
        return new $this->collectionNamePath(
            $this->getFilter($request)
            ->sort()
            ->paginate()
        );
    }

    protected function getFilter($request)
    {
        return call_user_func_array(
            "{$this->modelClassNamePath}::filter",
            array($request)
        );
    }

    public function getOne($model, $extraInfo = [])
    {
        return new $this->resourceNamePath($model, $extraInfo);
    }

    public function updateOne($request, $model)
    {
        $model->update( $request );
        return $this->getOne($model);
    }
    public function deleteOne( $model )
    {
        $model->delete();
    }

}