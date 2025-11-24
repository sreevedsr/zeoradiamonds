<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        // Fetch a random state row from state_codes table
        $state = DB::table('state_codes')->inRandomOrder()->first();

        return [
            'name' => fake()->name(),

            // UNIQUE FIELDS
            'email' => fake()->unique()->safeEmail(),
            'merchant_code' => strtoupper(fake()->unique()->bothify('MER####')),
            'gst_no' => strtoupper(fake()->unique()->bothify('##AAAAA####A1Z#')),

            // FIXED ROLE
            'role' => 'merchant',

            // CONTACT DETAILS
            'phone' => fake()->numerify('9#########'),
            'state_code' => $state->state_code ?? 'KL',
            'state' => $state->state_name ?? 'Kerala',
            'address' => fake()->address(),

            // AUTH FIELDS
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
