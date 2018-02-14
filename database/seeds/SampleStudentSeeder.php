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
            DB::table('group_member')->insert([
                'user_account_username' => $userAccount->username,
                'group_code'            => 'IT-2017'
            ]);
        });

        //  fixed samples
        $juan               = new UserAccount();
        $juan->username     = 'juan';
        $juan->display_name = 'Juan Dela Cruz';
        $juan->password     = bcrypt('secret');

        $juan->save();

        $juanStudent                 = new Student();
        $juanStudent->student_number = '2018-1312345';
        $juan->student()->save($juanStudent);

        $ervinne               = new UserAccount();
        $ervinne->username     = 'ervinne';
        $ervinne->display_name = 'Ervinne Sodusta';
        $ervinne->password     = bcrypt('secret');

        $ervinne->save();

        $ervinneStudent                 = new Student();
        $ervinneStudent->student_number = '2018-1312346';
        $ervinne->student()->save($ervinneStudent);
    }

}
