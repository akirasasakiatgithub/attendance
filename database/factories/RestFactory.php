<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Database\Factories\AttendanceFactory;
use App\Models\Attendance;

class RestFactory extends Factory
{
    public $attendanceDateFaker;

    public $startTimeFaker;

    public $endTimeFaker;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attendanceDateFaker = AttendanceFactory::$attendanceDateFaker;
        return [
            'date' => $attendanceDateFaker,
            'start_break' => $attendanceDateFaker . $this->faker->time(' H:i:s'),
            'end_break' => $attendanceDateFaker . $this->faker->time(' H:i:s'),
        ];
    }

    public function breakOrder(): Factory
    {
        // $this->attendanceDateFaker = $this->attendance->attendanceDateFaker;
        $this->endTimeFaker = $this->faker()->time();
        $this->startTimeFaker = $this->faker()->time('H:i:s', $this->endTimeFaker);
        return $this->state(function (array $attributes, Attendance $attendance) {
            return new Sequence(
                ['start_break' => $attendance->date . '' . $this->startTimeFaker, 'end_break' => null, 'date' => $attendance->date],
                ['start_break' => null, 'end_break' => $attendance->date . '' . $this->endTimeFaker, 'date' => $attendance->date]
            );
        });
    }
}
