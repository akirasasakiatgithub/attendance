<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'tony',
            'start_break' => 35,
            'end_break' => '2000-01-01 00:00:01'
        ];
    }
}
