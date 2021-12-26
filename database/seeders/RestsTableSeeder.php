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
            'id_u' => '1',
            'date' => '2021-12-15',
            'start_break' => '2021-12-15 12:15:00',
            'created_at' => '2021-12-15 12:15:00',
            'updated_at' => '2021-12-15 12:15:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '1',
            'date' => '2021-12-15',
            'end_break' => '2021-12-15 13:15:00',
            'created_at' => '2021-12-15 13:15:00',
            'updated_at' => '2021-12-15 13:15:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-15',
            'start_break' => '2021-12-15 12:20:00',
            'created_at' => '2021-12-15 12:20:00',
            'updated_at' => '2021-12-15 12:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-15',
            'end_break' => '2021-12-15 13:20:00',
            'created_at' => '2021-12-15 13:20:00',
            'updated_at' => '2021-12-15 13:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-15',
            'start_break' => '2021-12-15 12:25:00',
            'created_at' => '2021-12-15 12:25:00',
            'updated_at' => '2021-12-15 12:25:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-15',
            'end_break' => '2021-12-15 13:25:00',
            'created_at' => '2021-12-15 13:25:00',
            'updated_at' => '2021-12-15 13:25:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '1',
            'date' => '2021-12-20',
            'start_break' => '2021-12-20 12:15:00',
            'created_at' => '2021-12-20 12:15:00',
            'updated_at' => '2021-12-20 12:15:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '1',
            'date' => '2021-12-20',
            'end_break' => '2021-12-20 13:15:00',
            'created_at' => '2021-12-20 13:15:00',
            'updated_at' => '2021-12-20 13:15:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-20',
            'start_break' => '2021-12-20 12:20:00',
            'created_at' => '2021-12-20 12:20:00',
            'updated_at' => '2021-12-20 12:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-20',
            'end_break' => '2021-12-20 13:20:00',
            'created_at' => '2021-12-20 13:20:00',
            'updated_at' => '2021-12-20 13:20:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-20',
            'start_break' => '2021-12-20 12:25:00',
            'created_at' => '2021-12-20 12:25:00',
            'updated_at' => '2021-12-20 12:25:00'
        ];
        DB::table('rests')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-20',
            'end_break' => '2021-12-20 13:25:00',
            'created_at' => '2021-12-20 13:25:00',
            'updated_at' => '2021-12-20 13:25:00'
        ];
        DB::table('rests')->insert($param);
    }
}
