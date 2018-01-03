<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\ViewComposers\User\Group;

use Illuminate\View\View;

/**
 * Description of GroupMembersViewComposer
 *
 * @author ervinne
 */
class TasksNotificationViewComposer
{

    public function compose(View $view)
    {
        $tasks = [];

        $user = Auth::user();

        $view->with("tasks", $tasks);
    }

}
