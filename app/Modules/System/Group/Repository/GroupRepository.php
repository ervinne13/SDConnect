<?php

namespace App\Modules\System\Group\Repository;

use App\Modules\Base\BaseRespository;
use App\Modules\System\Group\Group;
use App\Modules\System\User\UserAccount;

/**
 *
 * @author ervinne
 */
interface GroupRepository extends BaseRespository
{

    function getTypes(): array;

    function allByUserAccount(UserAccount $user);

    function accessibleByUserAccount(UserAccount $user);

    function joinGroup(Group $group, $username);

    function joinToAllSystemGeneratedGroups($username);

    function getMembers(Group $group);

    function isUserMemberOfGroup(Group $group, $username);
}
