<?php

namespace App\Modules\System\User\Repository\Impl;

use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Role\Role;
use App\Modules\System\User\UserAccount;
use App\Modules\System\User\UserAccountRole;
use App\Modules\User\System\Repository\UserRepository;

/**
 * Description of UserRepositoryDefaultImpl
 *
 * @author ervinne
 */
class UserRepositoryDefaultImpl extends BasicBaseRepository implements UserRepository
{

    function __construct()
    {
        parent::__construct(UserAccount::class);
    }

    public function assignRole(UserAccount $user, Role $role)
    {
        $attributes = [
            "user_account_username" => $user->username,
            "role_code"             => $role->code
        ];
        
        $assignedRole = UserAccountRole::firstOrNew($attributes);
        $assignedRole->save();
    }

    public function unassignRoles(UserAccount $user, array $roleCodes)
    {
        UserAccountRole::where("user_account_username", $user->username)
                ->whereIn("role_code", $roleCodes)
                ->delete();
    }

}
