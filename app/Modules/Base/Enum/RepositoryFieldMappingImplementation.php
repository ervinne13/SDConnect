<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Base\Enum;

/**
 * Enumerated Types for field mapping implementations.
 * Use constants while we wait for PHP 7.2 
 * @author ervinne
 */
class RepositoryFieldMappingImplementation
{

    const MANUAL          = "Manual";
    const SNAKE_TO_CAMEL  = "SnakeToCamelCase";
    const SNAKE_TO_PASCAL = "SnakeToPascalCase";

}
