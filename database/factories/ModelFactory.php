<?php

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

$factory->define(\CodeFin\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(\CodeFin\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'role' => \CodeFin\Models\User::ROLE_ADMIN
    ];
});

$factory->define(\CodeFin\Models\BankAccount::class, function (Faker\Generator $faker) {
    return [
        'name'      =>  $faker->city,
        'agency'    =>  rand(10000, 60000). '-' .rand(0,9),
        'account'   =>  $faker->bankAccountNumber,
    ];
});

$factory->define(\CodeFin\Models\BillPays::class, function (Faker\Generator $faker) {
    return [
        'name'      =>  $faker->name,
        'date_due'  =>  $faker->date(),
        'done'      =>  rand(0,1),
        'value'     =>  $faker->numberBetween(10,1000),
    ];
});

$factory->define(\CodeFin\Models\BillReceive::class, function (Faker\Generator $faker) {
    return [
        'name'      =>  $faker->name,
        'date_due'  =>  $faker->date(),
        'done'      =>  rand(0,1),
        'value'     =>  $faker->numberBetween(10,1000),
    ];
});

$factory->define(\CodeFin\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});