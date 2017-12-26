<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Base\Mappers\Impl;

use App\Modules\Base\Mappers\AttributeMapper;

/**
 * Description of SnakeToCamelCaseFieldColumnMapper
 *
 * @author ervinne
 */
class SnakeToCamelCaseAttributeMapper extends SnakeToPascalCaseAttributeMapper implements AttributeMapper
{

    public function map(array $attributes)
    {
        $mappedAttributes = [];
        foreach ( $attributes AS $key => $value ) {
            $mappedAttributes[lcfirst(str_replace('_', '', ucwords($key, '_')))] = $value;
        }

        return $mappedAttributes;
    }

}
