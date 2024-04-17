<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'is_admin' => false,
            'provider' => null,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('test'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => $attributes['created_at'],
        ]);
    }

    public function old(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(30),
        ]);
    }
}
