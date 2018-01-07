<?php

use App\Modules\System\User\Student;
use App\Modules\System\User\UserAccount;
use Illuminate\Database\Seeder;

class SampleStudentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserAccount::class, 50)->create()->each(function ($userAccount) {
            $userAccount->student()->save(factory(Student::class)->make());
        });
    }

}
