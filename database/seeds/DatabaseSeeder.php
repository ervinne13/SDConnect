<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        try {
            DB::beginTransaction();

            $this->call(RolesSeeder::class);
            $this->call(DefaultUsersSeeder::class);
            $this->call(DefaultGroupSeeder::class);

//            $this->call(SampleClassSeeder::class);
//            $this->call(SampleTaskSeeder::class);
//            
//            $this->call(SampleStudentSeeder::class);

            DB::commit();
        } catch ( Exception $e ) {
            DB::rollBack();
            throw $e;
        }
    }

}
