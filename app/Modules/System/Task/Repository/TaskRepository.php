<?php

namespace App\Modules\System\Task\Repository;

use App\Http\Requests\System\Task\SaveTaskRequest;

/**
 * Description of TaskRepository
 *
 * @author ervinne
 */
interface TaskRepository
{
    public function saveWithHttpRequest(SaveTaskRequest $request);
}
