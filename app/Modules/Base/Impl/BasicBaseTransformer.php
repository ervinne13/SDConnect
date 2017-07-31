<?php

namespace App\Modules\Base\Impl;

use App\Modules\Base\BaseTransformer;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of BasicBaseTransformer
 *
 * @author ervinne
 */
abstract class BasicBaseTransformer implements BaseTransformer
{

    protected $modelClass;

    /**
     * BaseRepository constructor.
     * @param string $modelClass
     */
    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function transformToAttributes($model): array
    {
        return $model->toArray();
    }

    public function transformToModel(array $json)
    {
        if ( $json["id"] ) {
            $model = $this->modelClass::find($json["id"]);
        } else {
            $model = new $this->modelClass;
        }

        $model->fill($json['attributes']);

        return $model;
    }

}
