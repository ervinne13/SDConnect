<?php

namespace App\Modules\System\Group\Repository\Impl;

use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Group\Group;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\User\UserAccount;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\RecursionContext\Exception;

/**
 * Description of UserRepositoryDefaultImpl
 *
 * @author ervinne
 */
class GroupRepositoryDefaultImpl extends BasicBaseRepository implements GroupRepository
{

    protected $willReturnQueryObject = false;

    public function __construct(BaseTransformer $transformer = null)
    {
        parent::__construct(Group::class, $transformer);
    }

    public function getTypes(): array
    {
        return [
            "Generic",
            "Faculty",
            "Class",
        ];
    }

    public function accessibleByUserAccount(UserAccount $user)
    {
        return Group::select("group.*")
                ->where("user_account_username", $user->getUsername())
                ->rightJoin('group_member', function($join) {
                    $join->on('group_code', '=', 'code');
                })
                ->get();
    }

    public function allByUserAccount(UserAccount $user)
    {
        return Group::ownedByUsername($user->getUsername())->get();
    }

    public function getMembers(Group $group)
    {
        $query = UserAccount::select("user_account.*")
            ->where("group_code", $group->getCode())
            ->rightJoin('group_member', function($join) {
            $join->on('user_account_username', '=', 'username');
        });

        if ( $this->willReturnQueryObject ) {
            return $query;
        } else {
            return $query->get();
        }
    }

    public function create($attributesOrModel)
    {
        DB::beginTransaction();

        try {
            $savedGroup = parent::create($attributesOrModel);

            //  make current user a member
            $username = $this->getActingAsUser()->getUsername();
            $this->joinGroup($savedGroup, $username);
        } catch ( Exception $ex ) {
            DB::rollback();
            throw $ex;
        }

        DB::commit();
    }

    public function joinGroup(Group $group, $username)
    {
        $group->members()->attach($username);
    }

}
