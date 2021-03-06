<?php


use App\Group;
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

$factory->define(Group::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $image = generateAvatarByName($firstName, $lastName);
    return [
        'title' =>$faker->text,
        'desc' => $faker->text,
        'image' => $image,
    ];
});
