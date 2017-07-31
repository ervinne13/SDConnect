<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\ViewComposers\Calendar;

use App\Modules\System\Group\Repository\GroupRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Description of CalendarViewComposer
 *
 * @author ervinne
 */
class CalendarViewComposer
{

    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function compose(View $view)
    {
        $view->with("userGroups", $this->groupRepository->allByUserAccount(Auth::user()));
    }

}
