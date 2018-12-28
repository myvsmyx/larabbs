<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {

    $sentence = $faker->sentence();

    //随机取一个月以内的时间
    $update_at = $faker->dateTimeThisMonth();
    $create_at = $faker->dateTimeThisMonth($update_at);
    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $create_at,
        'updated_at' => $update_at,
    ];
});
