<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* User::factory()->count(50)
        ->has(
            Attendance::factory()->attendanceOrder()->count(rand(1, 6))
        )
        ->has(
            Rest::factory()->breakOrder()->count(rand(0,5))
        )
        ->create(); */
        for ($i=0;$i<20;$i++) {
            $param = [
                'name' => Str::rand,
                'age' => rand(18, 60),
                'password' => User::factory()->faker->password,
            ];
            User::create($param);
        }
        
    }
}
