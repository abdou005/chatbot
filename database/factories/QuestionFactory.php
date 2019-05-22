<?php

use App\Question;
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

$factory->define(Question::class, function (Faker $faker) {
    return [
        'question' => $faker->text.' ?',
        'response' => $faker->text,
        'group_id' => rand(1,10),
    ];
});
