<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class RestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_break' => $this->faker->dateTime(),
            'end_break' => $this->faker->dateTime(),
            'id_u' => User::factory(),
            //'created_at'はstart(end)_breakと揃えたい
        ];
    }
}
