<?php

namespace App\Modules\System\Task\Repository\Impl;

use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Task\Repository\TaskRepository;
use App\Modules\System\Task\Task;

/**
 * Description of TaskRepositoryDefaultImpl
 *
 * @author ervinne
 */
class TaskRepositoryDefaultImpl extends BasicBaseRepository implements TaskRepository
{

    public function __construct(BaseTransformer $transformer = null)
    {
        parent::__construct(Task::class, $transformer);
    }

    
    
}
