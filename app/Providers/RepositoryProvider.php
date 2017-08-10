<?php

namespace App\Providers;

use App\Modules\System\Group\Repository\GroupRepository;
use App\Modules\System\Group\Repository\Impl\GroupRepositoryDefaultImpl;
use App\Modules\System\Group\Transformers\GroupTransformer;
use App\Modules\System\Post\Repository\Impl\PostRepositoryDefaultImpl;
use App\Modules\System\Post\Repository\PostRepository;
use App\Modules\System\Role\Repository\Impl\RoleRepositoryDefaultImpl;
use App\Modules\System\Role\Repository\RoleRepository;
use App\Modules\System\Task\Repository\Impl\TaskRepositoryDefaultImpl;
use App\Modules\System\Task\Repository\TaskRepository;
use App\Modules\System\User\Repository\Impl\UserRepositoryDefaultImpl;
use App\Modules\System\User\Transformers\UserAccountTransformer;
use App\Modules\User\System\Repository\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $userAccountTransformer = new UserAccountTransformer();
        $groupTransformer       = new GroupTransformer($userAccountTransformer);
        $groupRepo              = new GroupRepositoryDefaultImpl($groupTransformer);

        $this->app->bind(UserRepository::class, function() use ($groupRepo) {
            $transformer = new UserAccountTransformer();
            return new UserRepositoryDefaultImpl($groupRepo, $transformer);
        });

        $this->app->bind(GroupRepository::class, function() use ($groupRepo) {
            return $groupRepo;
        });

        $this->app->bind(RoleRepository::class, RoleRepositoryDefaultImpl::class);
        $this->app->bind(PostRepository::class, PostRepositoryDefaultImpl::class);
        $this->app->bind(TaskRepository::class, TaskRepositoryDefaultImpl::class);
    }

    public function provides()
    {
        return [
            UserRepository::class,
            RoleRepository::class,
            GroupRepository::class,
            PostRepository::class,
        ];
    }

}
