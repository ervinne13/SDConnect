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

        //  fixed sample
        $juan               = new UserAccount();
        $juan->username     = 'juan';
        $juan->display_name = 'Juan Dela Cruz';
        $juan->password     = bcrypt('secret');

        $juan->save();

        $juanStudent                  = new Student();
        $juanStudent->student_number = '2018-1312345';
        $juan->student()->save($juanStudent);
    }

}
