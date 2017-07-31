<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of RequestToModelTransformingRequest
 *
 * @author ervinne
 */
interface RequestToModelTransformingRequest
{

    function getRequestModel(): Model;
}
