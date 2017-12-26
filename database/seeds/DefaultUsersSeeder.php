<?php

use App\Modules\System\Role\Repository\RoleRepository;
use App\Modules\System\User\UserAccount;
use App\Modules\User\System\Repository\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DefaultUsersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var UserRepository $userRepository
         */
        $userRepository = App::make(UserRepository::class);
        $roleRepository = App::make(RoleRepository::class);

        $adminAttr = [
            "username"     => "admin",
            "display_name" => "Administrator",
            "password"     => \Hash::make("secret"),
        ];

        $administrator = $userRepository->create($adminAttr);
        $userRepository->assignRole($administrator, $roleRepository->find(RoleRepository::ROLE_ADMIN));
    }

}
