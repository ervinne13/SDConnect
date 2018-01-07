<?php

namespace App\Modules\User\System\Repository;

use App\Modules\Base\BaseRespository;
use App\Modules\System\Role\Role;
use App\Modules\System\User\UserAccount;

/**
 *
 * @author ervinne
 */
interface UserRepository extends BaseRespository
{    
    
    function createStudent($attributesOrModel, $studentNumber);
    
    function assignRole(UserAccount $user, Role $role);

    function unassignRoles(UserAccount $user, array $roleCodes);
}
