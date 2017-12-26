<?php

use App\Modules\System\Group\Group;
use App\Modules\System\Group\Repository\Impl\GroupRepositoryDefaultImpl;
use App\Modules\System\User\UserAccount;
use Illuminate\Database\Seeder;

class DefaultGroupSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $group = new Group();
        $group->setCode("SDCA")
            ->setOwner(UserAccount::find('admin'))
            ->setType('Generic')
            ->setDisplayName("Saint Dominic College of Asia Global Group")
            ->setDescription("Saint Dominic College of Asia Global Group\n\nAll school-wide events and notes are posted here")
//            ->setColor('#912424')
            ->setColor('#ebcdcd')
            ->setSystemGenerated()
        ;

        $groupRepo = new GroupRepositoryDefaultImpl();
        $groupRepo
            ->actingAs(UserAccount::find('admin'))
            ->create($group);
    }

}
