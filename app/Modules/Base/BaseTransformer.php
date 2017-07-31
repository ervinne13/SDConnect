<?php

namespace App\Modules\Base;

/**
 *
 * @author ervinne
 */
interface BaseTransformer
{

    function getJsonRelationships();

    function transformToWrappedJson($model): array;

    function transformToAttributes($model): array;

    function transformToModel(array $assocModel);
}
