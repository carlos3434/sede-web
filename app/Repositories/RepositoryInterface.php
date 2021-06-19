<?php namespace App\Repositories;

/**
 * RepositoryInterface provides the standard functions to be expected of ANY 
 * repository.
 */
interface RepositoryInterface {

    //wiki
	public function find($id);
	public function create(array $attributes);
	public function destroy($ids);

	//custom
    public function all($request);
    public function getOne($model);
    public function updateOne($request, $model);
    public function deleteOne( $model );

}