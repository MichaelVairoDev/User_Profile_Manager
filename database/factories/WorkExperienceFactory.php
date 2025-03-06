<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WorkExperienceFactory extends Factory
{
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-10 years', '-1 month');
        $isCurrentJob = fake()->boolean(20); // 20% de probabilidad de ser trabajo actual

        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'position' => fake()->jobTitle(),
            'description' => fake()->paragraphs(2, true),
            'start_date' => $startDate,
            'end_date' => $isCurrentJob ? null : fake()->dateTimeBetween($startDate, 'now'),
            'current_job' => $isCurrentJob,
            'location' => fake()->city() . ', ' . fake()->country(),
            'company_website' => fake()->url(),
        ];
    }

    public function current(): static
    {
        return $this->state(fn (array $attributes) => [
            'current_job' => true,
            'end_date' => null,
        ]);
    }
}
