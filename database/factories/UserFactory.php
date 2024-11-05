<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'newsletter' => $this->faker->boolean(),
            'last_seen' => $this->faker->dateTimeBetween('-6 months'),
            'admin' => false,
            'created_at' => $this->faker->dateTimeBetween('-4 years', '-6 months'),
        ];
    }
}
