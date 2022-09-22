<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'no_of_employees' => rand(5,25)
        ];
    }

    public function addUserId($user_id)
    {
        return $this->state(function ($attributes) use ($user_id) {
            return ['user_id' => $user_id];
        });
    }
}
