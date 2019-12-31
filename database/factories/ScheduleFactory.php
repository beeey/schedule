<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $startsAt = $faker->dateTimeBetween('-30 days', '+30 days');
    $endsAt = (clone $startsAt)->add(DateInterval::createFromDateString(sprintf('+%d hours', mt_rand(1, 6))));

    return [
        'starts_at' => $startsAt,
        'ends_at' => $endsAt,
        'title' => $faker->realText(50),
        'content' => $faker->realText(),
    ];
});
