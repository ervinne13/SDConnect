<?php

namespace App\Modules\System\Post\Repository\Impl;

use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Post\Post;
use App\Modules\System\Post\Repository\PostRepository;
use App\Modules\System\User\UserAccount;
use Exception;

/**
 * Description of PostRepositoryDefaultImpl
 *
 * @author ervinne
 */
class PostRepositoryDefaultImpl extends BasicBaseRepository implements PostRepository
{

    public function __construct(BaseTransformer $transformer = null)
    {
        parent::__construct(Post::class, $transformer);
    }

    public function create($attributesOrModel)
    {
        $group = $attributesOrModel->group_code;
        $task = $attributesOrModel->related_data_id;
        
        if ($attributesOrModel->module == 'Task') {
            $existingTaskCount = Post::whereGroupCode($group)->whereRelatedDataId($task)->count();
            
            if ($existingTaskCount > 0) {
                throw new Exception("You cannot post the same task on the same group. You may only reuse tasks across different groups");
            }
        }
        
        parent::create($attributesOrModel);
    }
    
    public function getPostsByDateRange(UserAccount $accessibleByUser, $startDate, $endDate, $group = null)
    {
        $query = Post::AccessibleByUsername($accessibleByUser->getUsername())
            ->where("date_time_from", ">=", $startDate)
            ->where("date_time_to", "<=", $endDate)
            ->with('author')
            ->with('group');

        if ( $group ) {
            $query->here("group_code", $group);
        }

        return $query->get();
    }

    public function getPaginatedFromGroup(string $groupCode)
    {
        $query = Post::where("group_code", $groupCode)
            ->with('author')
            ->with('group');
        return $this->getPaginatedRecordsFromQuery($query);
    }

}
