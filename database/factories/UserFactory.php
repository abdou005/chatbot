<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $image = generateAvatarByName($firstName, $lastName);
    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'image' => $image,
        'role' => User::VISITOR,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'),
        'pwd_c'=> '12345678',
    ];
});
