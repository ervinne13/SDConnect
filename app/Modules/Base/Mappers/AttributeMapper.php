<?php

namespace App\Modules\Base\Mappers;

/**
 *
 * @author ervinne
 */
interface AttributeMapper
{

    function map(array $attributes);

    function unmap(array $attributes);
}
