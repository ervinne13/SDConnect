<?php

use App\Modules\System\Role\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ "code" => "ADMIN", "display_name" => "Administrator" ],
            [ "code" => "TEACHER", "display_name" => "Teacher" ],
            [ "code" => "STUDENT", "display_name" => "Student" ],
            [ "code" => "CONTENT_CREATOR", "display_name" => "Content Creator" ],
        ];

        Role::insert($roles);
    }

}
