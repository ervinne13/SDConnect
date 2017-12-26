<?php

namespace App\Modules\Base\Mappers\Impl;

use App\Modules\Base\Mappers\AttributeMapper;

/**
 * Description of SnakeToPascalCaseFieldColumnMapper
 *
 * @author ervinne
 */
class SnakeToPascalCaseAttributeMapper implements AttributeMapper
{

    public function map(array $attributes)
    {
        $mappedAttributes = [];
        foreach ( $attributes AS $key => $value ) {
            $mappedAttributes[str_replace('_', '', ucwords($key, '_'))] = $value;
        }

        return $mappedAttributes;
    }

    public function unmap(array $attributes)
    {
        $mappedAttributes = [];
        foreach ( $attributes AS $key => $value ) {
            $mappedAttributes[$this->stringToSnakeCase($key)] = $value;
        }

        return $mappedAttributes;
    }

    protected function stringToSnakeCase(string $string)
    {
        $splitted = array_map(function ($word) {
            return strtolower($word);
        }, preg_split('/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY));

        return implode("_", $splitted);
    }

}
