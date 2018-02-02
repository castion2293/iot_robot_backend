<?php

use Faker\Generator as Faker;

$factory->define(App\Robot::class, function (Faker $faker) {
    return [
        'serial_number' => '88273',
        'robot_type' => 'TV600',
        'controller_type' => 'TS3100'
    ];
});
