<?php

use Carbon\Carbon;

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


$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $title=$faker->name;
    return[
        'name'          =>$title,
        'slug'          =>str_slug($title, "-"),
        'category_id'   =>rand(1,2),
        'price'         =>$faker->randomFloat(2, 20, 2000),
        'abstract'      =>$faker->paragraph(rand(1,4)),
        'content'       =>$faker->paragraph(rand(3,6)),
        'published_at'  =>$faker->dateTime('now')
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    static $userId = 0;

    return[
        'user_id'        =>++$userId,
        'address'        =>$faker->address,
        'number_card'    =>$faker->creditCardNumber,
    ];
});
