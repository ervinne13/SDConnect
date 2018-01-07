<?php

namespace App\Providers;

use App\ViewComposers\Calendar\CalendarViewComposer;
use App\ViewComposers\SkarlaViewComposer;
use App\ViewComposers\User\Group\TasksNotificationViewComposer;
use App\ViewComposers\User\Group\UserGroupSelectionDropdownViewComposer;
use Illuminate\Support\ServiceProvider;
use function view;

class ViewComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', SkarlaViewComposer::class);

        $this->composeUserGroupViews();
        $this->composeCalendarViews();

        view()->composer('layouts.parts.navbar.tasks', TasksNotificationViewComposer::class);
    }

    protected function composeUserGroupViews()
    {
        view()->composer('layouts.parts.navbar.user-group-selection-dropdown', UserGroupSelectionDropdownViewComposer::class);
        view()->composer('views.user.group.group-members', UserGroupSelectionDropdownViewComposer::class);
    }

    protected function composeCalendarViews()
    {
        view()->composer('views.calendar.calendar-view', CalendarViewComposer::class);
    }

}
