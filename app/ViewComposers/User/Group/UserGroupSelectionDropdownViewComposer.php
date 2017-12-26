<?php

namespace App\ViewComposers\User\Group;

use App\Modules\System\Group\Repository\GroupRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

/**
 * Description of SkarlaViewComposer
 *
 * @author ervinne
 */
class UserGroupSelectionDropdownViewComposer
{

    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function compose(View $view)
    {
        $currentGroup = Route::current()->parameter('groupCode');
        if ( !$currentGroup ) {
            $currentGroup = null;
        }

        if ( Auth::check() ) {
            $userGroups = $this->groupRepository->accessibleByUserAccount(Auth::user());
        } else {
            $userGroups = [];
        }

        $view->with("currentGroup", $currentGroup);
        $view->with("userGroups", $userGroups);
    }

}
