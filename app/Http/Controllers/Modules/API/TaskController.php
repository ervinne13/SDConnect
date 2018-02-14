<?php

namespace App\Http\Controllers\Modules\API;

use App\Http\Controllers\Controller;
use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Task\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    public function listAll()
    {
        return Task::all();
    }

    public function listAllMobile(GroupRepository $groupRepository)
    {
        $user          = Auth::user();
        $userGroups    = $groupRepository->accessibleByUserAccount(Auth::user());
        $groupCodeList = array_column($userGroups->toArray(), 'code');

        //  don't bother with the unoptimzed query with filter, this will be rewritten
        //  in CI anyway
        $groupedTasks = Task::with('post')
            ->with('items')
            ->userGroups($groupCodeList)
            ->withStudentNumberOfUser($user)
            ->get()
            ->filter(function($task) {
            return $task->student_number != Auth::user()->student->student_number;
        });

        Log::info($groupedTasks);
        
        return array_values($groupedTasks->toArray());
    }


}
