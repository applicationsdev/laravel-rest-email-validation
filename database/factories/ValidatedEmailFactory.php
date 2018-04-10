<?php

use Faker\Generator as Faker;
use App\ValidatedEmail;

$factory->define(ValidatedEmail::class, function (Faker $faker) {
    
    $randomValidEmail = $faker->unique()->email;
    $randomInvalidEmail = str_random(18);
    
    return [
        'email' => $faker->randomElement([
            $randomValidEmail,
            $randomInvalidEmail,
        ]),
    ];
});
