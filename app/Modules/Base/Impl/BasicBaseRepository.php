<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Base\Impl;

use App\Modules\Base\BaseRespository;
use App\Modules\Base\BaseTransformer;
use App\Modules\System\User\UserAccount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use function collect;

/**
 * Description of BasicBaseRepository
 *
 * @author ervinne
 */
abstract class BasicBaseRepository implements BaseRespository
{

    /** @var BaseTransformer  */
    protected $transformer;
    protected $willTransformModel      = false;
    protected $willUseTransactions     = false;
    protected $willReturnQueryObject   = false;
    protected $eagerLoadsRelationships = [];

    /** @var UserAccount */
    private $actingAsUserAccount;

    /**
     * BaseRepository constructor.
     * @param string $modelClass
     */
    public function __construct(string $modelClass, BaseTransformer $transformer = null)
    {
        $this->modelClass  = $modelClass;
        $this->transformer = $transformer;

        if ( $this->transformer === null ) {
            $this->willTransformModel(false);
        }
    }

    public function actingAs(UserAccount $userAccount)
    {
        $this->actingAsUserAccount = $userAccount;
        return $this;
    }

    protected function getActingAsUser()
    {
        if ( !$this->actingAsUserAccount && Auth::check() ) {
            $this->actingAsUserAccount = Auth::user();
        }

        return $this->actingAsUserAccount;
    }

    public function returnsQueryObject(bool $willReturnQueryObject = true)
    {
        $this->willReturnQueryObject = $willReturnQueryObject;
        return $this;
    }

    public function willTransformModel(bool $willTransformModel = true)
    {
        $this->willTransformModel = $willTransformModel;
        return $this;
    }

    public function eagerLoadsRelationships(array $relatedModels)
    {
        $this->eagerLoadsRelationships = $relatedModels;
        return $this;
    }

    public function useTransactions(bool $willUseTransactions = true)
    {
        $this->willUseTransactions = $willUseTransactions;
        return $this;
    }

    public function all($columns = array(), string $orderBy = 'id', string $sortBy = 'desc')
    {
        $query = $this->model::orderBy($orderBy, $sortBy);

        if ( count($columns) > 0 ) {
            $query->select($columns);
        }

        return $this->getArrayListFromQuery($query);
    }

    public function create($attributesOrModel)
    {
        $model = $this->fillModel($attributesOrModel, new $this->modelClass());
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        return $this->modelClass::destroy($id);
    }

    public function find($id)
    {
        return $this->findModel($this->getFindQuery($id));
    }

    public function findOrFail($id)
    {
//  true = fail if not found
        return $this->findModel($this->getFindQuery($id), true);
    }

    public function update($attributesOrModel, $id)
    {
        $model = $this->fillModel($attributesOrModel, $this->find($id));
        $model->update();

        return $model;
    }

    public function getPaginatedRecords(int $pageSize = 15, string $orderBy = 'id', string $sortBy = 'desc')
    {
        return $this->modelClass::orderBy($orderBy, $sortBy)->simplePaginate($pageSize);
    }

    public function getPaginatedRecordsFromQuery($query, int $pageSize = 15, string $orderBy = 'id', string $sortBy = 'desc')
    {
        return $query->orderBy($orderBy, $sortBy)->simplePaginate($pageSize);
    }

    protected function eagerLoadDependencies($query)
    {
        foreach ( $this->eagerLoadsRelationships AS $dependency ) {
            $query->with($dependency);
        }

        if ( $this->transformer ) {
            collect($this->transformer->getJsonRelationships())
                ->each(function($dependency) use ($query) {
                    $query->with($dependency);
                });
        }

        return $query;
    }

    protected function getArrayListFromQuery($query)
    {
        if ( $this->willTransformModel ) {
            $query = $this->eagerLoadDependencies($query);
            return collect($query->get())
                    ->each(function($model) {
                        return $this->transformer->transformToWrappedJson($model);
                    });
        } else {
            return collect($query->get())->toArray();
        }
    }

    protected function getFindQuery($id)
    {
        $modelInstance = new $this->modelClass();
        $query         = $this->modelClass::query();

//  if composite key, map values
        if ( is_array($id) ) {
            if ( !is_array($modelInstance->getKeyName()) || count($modelInstance->getKeyName()) !== count($id) ) {
                throw new ModelNotFoundException("Invalid primary key or incorrect keys given to find the model in {$this->modelClass}");
            }

            for ( $i = 0; $i < count($modelInstance->getKeyName()); $i ++ ) {
                $query->where($modelInstance->getKeyName()[$i], $id[$i]);
            }
        } else {
            $query->where($modelInstance->getKeyName(), $id);
        }

        return $query;
    }

    protected function findModel($query, bool $andFail = false)
    {
        $queryWithRelatedModels = $this->eagerLoadDependencies($query);

        if ( $this->willTransformModel ) {
            $model = $andFail ? $queryWithRelatedModels->firstAndFail() : $queryWithRelatedModels->first();
            return $this->transformer->transformToWrappedJson($model);
        } else if ( $andFail ) {
            return $queryWithRelatedModels->firstAndFail();
        } else {
            return $queryWithRelatedModels->first();
        }
    }

    protected function fillModel($attributesOrModel, $model)
    {
        if ( is_array($attributesOrModel) ) {
            $model->fill($attributesOrModel);
        } else {
//            $model = $attributesOrModel;
            $model->fill($attributesOrModel->toArray());
        }

        return $model;
    }

}
