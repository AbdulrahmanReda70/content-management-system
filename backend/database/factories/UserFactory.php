<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
        'username' => $this->faker->unique()->userName,
        'email' => $this->faker->unique()->safeEmail,
        'password' => $this->faker->password,
        'user_role' => 'admin',
    ];
    }
}
