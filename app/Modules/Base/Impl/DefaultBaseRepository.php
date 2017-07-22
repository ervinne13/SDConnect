<?php

namespace App\Modules\Base\Impl;

/**
 * Description of DefaultBaseRepository
 *
 * @author ervinne
 */
class DefaultBaseRepository implements \App\Modules\Base\BaseRespository
{

    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($columns = array(), string $orderBy = 'id', string $sortBy = 'desc')
    {
        
    }

    public function create(array $attributes)
    {
        
    }

    public function delete(int $id)
    {
        
    }

    public function find(int $id)
    {
        
    }

    public function findBy(array $data)
    {
        
    }

    public function findOneBy(array $data)
    {
        
    }

    public function findOneByOrFail(array $data)
    {
        
    }

    public function findOneOrFail(int $id)
    {
        
    }

    public function getPaginatedResults(int $paginated = 25, string $orderBy = 'id', string $sortBy = 'desc')
    {
        
    }

    public function paginateArrayResults(array $data, int $perPage = 50)
    {
        
    }

    public function update(array $attributes, int $id)
    {
        
    }

}
