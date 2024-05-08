<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->text(rand(6, 120));

        return [
            'title' => $title,
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'completed'])
        ];
    }
}
