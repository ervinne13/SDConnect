<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Base\Mappers\Impl;

use App\Modules\Base\Mappers\AttributeMapper;

/**
 * Description of ManualFieldColumnMapper
 *
 * @author ervinne
 */
class ManualFieldAttributeMapper implements AttributeMapper
{

    protected $columnMapping;

    function __construct(array $columnMapping)
    {
        $this->columnMapping = $columnMapping;
    }

    public function map(array $attributes)
    {
        foreach ( $this->columnMapping AS $databaseColumn => $modelProperty ) {
            $attributes[$databaseColumn] = $attributes[$modelProperty];
            unset($attributes[$modelProperty]);
        }
    }

    public function unmap(array $attributes)
    {
        foreach ( $this->columnMapping AS $databaseColumn => $modelProperty ) {
            $attributes[$modelProperty] = $attributes[$databaseColumn];
            unset($attributes[$modelProperty]);
        }
    }

}
