<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'firstname' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'remember_token' => Str::random(10),
        'newsletter' => $faker->boolean(),
        'last_seen' => $faker->dateTimeBetween('-6 months'),
        'admin' => false,
        'created_at' => $faker->dateTimeBetween('-4 years', '-6 months'),
    ];
});
