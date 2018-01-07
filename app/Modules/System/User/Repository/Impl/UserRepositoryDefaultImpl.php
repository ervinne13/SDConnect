<?php

namespace App\Modules\System\User\Repository\Impl;

use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Role\Role;
use App\Modules\System\User\Student;
use App\Modules\System\User\UserAccount;
use App\Modules\System\User\UserAccountRole;
use App\Modules\User\System\Repository\UserRepository;
use Illuminate\Support\Facades\DB;

/**
 * Description of UserRepositoryDefaultImpl
 *
 * @author ervinne
 */
class UserRepositoryDefaultImpl extends BasicBaseRepository implements UserRepository
{

    /** @var GroupRepository */
    protected $groupRepo;

    function __construct(GroupRepository $groupRepo)
    {
        parent::__construct(UserAccount::class);

        $this->groupRepo = $groupRepo;
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

    public function createStudent($attributesOrModel, $studentNumber)
    {
        return DB::transaction(function() use ($attributesOrModel, $studentNumber) {
                $user = parent::create($attributesOrModel);

                $student = new Student();

                $student->student_number        = $studentNumber;
                $student->is_active             = true;
                $student->user_account_username = $user->username;

                $student->save();

                $this->groupRepo->joinToAllSystemGeneratedGroups($user->getUsername());

                return $user;
            });
    }

}
