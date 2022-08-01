<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_break' => '2022-08-01 12:15:00',
            'end_break' => null,
            'created_at' => '2022-08-01 12:15:00',
            'updated_at' => '2022-08-01 12:15:00'
        ];
        DB::table('rests')->insert($param);

        /* $param = [
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_break' => null,
            'end_break' => '2022-08-01 13:15:00',
            'created_at' => '2022-08-01 13:15:00',
            'updated_at' => '2022-08-01 13:15:00'
        ];
        DB::table('rests')->insert($param); */

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_break' => '2022-08-01 11:20:00',
            'end_break' => null,
            'created_at' => '2022-08-01 12:20:00',
            'updated_at' => '2022-08-01 12:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_break' => null,
            'end_break' => '2022-08-01 11:40:00',
            'created_at' => '2022-08-01 13:20:00',
            'updated_at' => '2022-08-01 13:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_break' => '2022-08-01 12:20:00',
            'end_break' => null,
            'created_at' => '2022-08-01 12:25:00',
            'updated_at' => '2022-08-01 12:25:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_break' => null,
            'end_break' => '2022-08-01 12:25:00',
            'created_at' => '2022-08-01 13:25:00',
            'updated_at' => '2022-08-01 13:25:00'
        ];
        DB::table('rests')->insert($param);

        /* $param = [
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_break' => '2022-08-01 12:15:00',
            'end_break' => null,
            'created_at' => '2022-08-01 12:15:00',
            'updated_at' => '2022-08-01 12:15:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_break' => null,
            'end_break' => '2022-08-01 13:15:00',
            'created_at' => '2022-08-01 13:15:00',
            'updated_at' => '2022-08-01 13:15:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_break' => '2022-08-01 12:20:00',
            'end_break' => null,
            'created_at' => '2022-08-01 12:20:00',
            'updated_at' => '2022-08-01 12:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_break' => null,
            'end_break' => '2022-08-01 13:20:00',
            'created_at' => '2022-08-01 13:20:00',
            'updated_at' => '2022-08-01 13:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_break' => '2022-08-01 12:25:00',
            'end_break' => null,
            'created_at' => '2022-08-01 12:25:00',
            'updated_at' => '2022-08-01 12:25:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_break' => null,
            'end_break' => '2022-08-01 13:25:00',
            'created_at' => '2022-08-01 13:25:00',
            'updated_at' => '2022-08-01 13:25:00'
        ];
        DB::table('rests')->insert($param); */
    }
}
