<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class AttendanceFactory extends Factory
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
        self::$attendanceDateFaker = $this->faker->date('Y-m-d', 'now');
        return [
            'date' => self::$attendanceDateFaker,
            'start_working' => self::$attendanceDateFaker . $this->faker->time(' H:i:s'),
            'end_working' => self:: $attendanceDateFaker . $this->faker->time(' H:i:s'),
        ];
    }

    public function attendanceOrder(): Factory
    {
        $this->attendanceDateFaker = $this->faker()->date();
        $this->endTimeFaker = $this->faker()->time();
        $this->startTimeFaker = $this->faker()->time('H:i:s', $this->endTimeFaker);
        return $this->state(new Sequence(
            ['start_working' => self::$attendanceDateFaker .''. $this->startTimeFaker, 'end_working' => null],
            ['start_working' => null, 'end_working' => self::$attendanceDateFaker .''. $this->endTimeFaker]
        ));
    }
}
