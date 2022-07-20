<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_working' => $this->faker->dateTimeBetween(User::factory()->make()->created_at),
            'end_working' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'id_u' => User::factory()->make()->id,
            //'created_at'はstart(end)_workingと揃えたい
        ];
    }
}
