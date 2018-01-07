<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\ViewComposers\User\Group;

use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Task\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function dd;

/**
 * Description of GroupMembersViewComposer
 *
 * @author ervinne
 */
class TasksNotificationViewComposer
{

    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function compose(View $view)
    {
        $user          = Auth::user();
        $userGroups    = $this->groupRepository->accessibleByUserAccount(Auth::user());
        $groupCodeList = array_column($userGroups->toArray(), 'code');

        //  don't bother with the unoptimzed query with filter, this will be rewritten
        //  in CI anyway
        $tasks = Task::with('post')
            ->userGroups($groupCodeList)
            ->withStudentNumberOfUser($user)
            ->get()
            ->filter(function($task) {
            return $task->student_number != Auth::user()->student->student_number;
        });
        
        $view->with("tasks", $tasks);
    }

}
