<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password        = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Modules\System\Post\Post::class, function (Faker\Generator $faker) {

    $author = App\Modules\System\User\UserAccount::find('admin');
    $group  = App\Modules\System\Group\Group::find('SDCA');

    $startingDate = $faker->dateTimeThisYear('+1 month');
//    $endingDate   = strtotime('+1 Week', $startingDate->getTimestamp());

    return [
        'author_username' => $author->username,
        'group_code'      => $group->code,
        'module'          => 'Post',
        'calendar_color'  => $group->color,
        'date_time_from'  => $startingDate,
        'date_time_to'    => $startingDate,
        'content'         => $faker->sentence,
    ];
});
