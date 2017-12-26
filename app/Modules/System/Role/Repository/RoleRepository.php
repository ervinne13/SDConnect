<?php

namespace App\Modules\System\Role\Repository;

use App\Modules\Base\BaseRespository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ervinne
 */
interface RoleRepository extends BaseRespository
{

    const ROLE_ADMIN           = "ADMIN";
    const ROLE_TEACHER         = "TEACHER";
    const ROLE_STUDENT         = "STUDENT";
    const ROLE_CONTENT_CREATOR = "CONTENT_CREATOR";

}
