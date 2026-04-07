<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
        'name' => fake()->company(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'address' => fake()->address(),
        'rfc' => strtoupper(fake()->bothify('????######???')),
        // Esto crea un nuevo usuario con rol 'client' para este cliente
        'user_id' => \App\Models\User::factory()->create(['role' => 'client'])->id,
    ];
    }
}
