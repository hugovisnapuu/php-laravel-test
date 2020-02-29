<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Customer::class, function (Faker $faker) {
    return [
        'company_id' => factory(\App\Company::class)->create(),
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        //'number' => $faker->phoneNumber,
        'number' => $faker->numerify('########'),
        'active' => 1
    ];
});
