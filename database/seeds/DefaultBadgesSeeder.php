<?php

use App\Modules\System\Badge\Badge;
use Illuminate\Database\Seeder;

class DefaultBadgesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badges = ['Punctuality', 'Creativity', 'Activeness', 'Early Bird'];
        foreach ( $badges as $badge ) {
            Badge::insert(['display_name' => $badge]);
        }
    }

}
