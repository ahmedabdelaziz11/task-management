<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'password' => Hash::make('password'),
            'salary' => $this->faker->randomFloat(2, 3000, 10000),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'role' => $this->faker->randomElement(['manager', 'employee']),
            'department_id' => \App\Models\Department::factory(),
        ];
    }

    public function manager()
    {
        return $this->state(function (array $attributes) {
            return [
                'manager_id' => User::factory(),
            ];
        });
    }
}
