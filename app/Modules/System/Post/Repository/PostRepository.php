<?php

namespace App\Modules\System\Post\Repository;

use App\Modules\Base\BaseRespository;

/**
 *
 * @author ervinne
 */
interface PostRepository extends BaseRespository
{

    public function getPostsByDateRange($startDate, $endDate, $group = null);

    public function getPaginatedFromGroup(string $groupCode);
}
