<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Base\Impl;

use function collect;

/**
 * Description of TransformableModelBaseRepository
 *
 * @author ervinne
 */
abstract class MappableAndTransformableModelBaseRepository extends MappableColumnModelBaseRepository implements BaseRepository
{

    public function find($id)
    {
        return $this->transform(parent::find($id));
    }

    public function findOrFail($id)
    {
        return $this->transform(parent::findOrFail($id));
    }

    public function all($columns = array(), string $orderBy = 'id', string $sortBy = 'desc')
    {
        $modelList = parent::all($columns, $orderBy, $sortBy);
        return collect($modelList)->map(function ($model) {
                    return $this->transform($model);
                }
        );
    }

    protected abstract function transform($model): array;
}
