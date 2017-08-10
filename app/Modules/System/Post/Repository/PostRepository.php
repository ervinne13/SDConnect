<?php

namespace App\Modules\System\Post\Repository;

use App\Modules\Base\BaseRespository;
use App\Modules\System\User\UserAccount;

/**
 *
 * @author ervinne
 */
interface PostRepository extends BaseRespository
{

    public function getPostsByDateRange(UserAccount $accessibleByUser, $startDate, $endDate, $group = null);

    public function getPaginatedFromGroup(string $groupCode);
}
