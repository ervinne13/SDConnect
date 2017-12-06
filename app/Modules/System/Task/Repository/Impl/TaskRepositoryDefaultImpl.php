<?php

namespace App\Modules\System\Task\Repository\Impl;

use App\Http\Requests\System\Task\SaveTaskRequest;
use App\Modules\Base\BaseTransformer;
use App\Modules\Base\Impl\BasicBaseRepository;
use App\Modules\System\Task\Repository\TaskRepository;
use App\Modules\System\Task\Task;
use App\Modules\System\Task\TaskItem;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function saveWithHttpRequest(SaveTaskRequest $request)
    {
        $request->decompose();

        try {
            DB::beginTransaction();

            $task = $request->getTask();
            $task->randomizes_tasks = $task->randomizes_tasks ? 1 : 0;
            $task->save();

            //  clear previously saved task items
            TaskItem::task($task->id)->delete();

            //  save the new task items
            $task->items()->saveMany($request->getTaskItems());

            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }

    }
    
}
