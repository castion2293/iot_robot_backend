<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'product_id' => '88273',
        'name' => 'TV800',
    ];
});
