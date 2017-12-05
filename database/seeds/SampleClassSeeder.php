<?php

use App\Modules\System\Group\Group;
use App\Modules\System\Group\Repository\Impl\GroupRepositoryDefaultImpl;
use App\Modules\System\User\UserAccount;
use Illuminate\Database\Seeder;

class SampleClassSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
        $group->setCode("IT-2017")
            ->setOwner(UserAccount::find('admin'))
            ->setType('Class')
            ->setDisplayName("IT 2017 Class")
            ->setDescription("Test class for creating tasks")
            ->setColor('#edf0f5')            
            ->setSystemGenerated()
        ;

        $groupRepo = new GroupRepositoryDefaultImpl();
        $groupRepo
            ->actingAs(UserAccount::find('admin'))
            ->create($group);
    }

}
