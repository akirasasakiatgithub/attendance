<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Database\Factories\AttendanceFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Attendance;
use App\Models\Rest;


class UserFactory extends Factory
{
    public static $signupDateFaker;

    public static $attendanceDateFaker;

    public static $attendanceTimeFaker;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attendanceDateFaker = AttendanceFactory::$attendanceDateFaker;
        self::$signupDateFaker = $this->faker->dateTime($attendanceDateFaker . $this->faker->time(' H:i:s'));
        return [
            'name' => Str::random(10),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password,
            //'id' => $this->faker->numberBetween(1, 100),
            'remember_token' => Str::random(10),
            'created_at' => self::$signupDateFaker,
            'updated_at' => self::$signupDateFaker,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
