<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendancesTableSeeder extends Seeder
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
            'start_working' => '2022-08-01 09:15:00',
            'end_working' => null,
            'created_at' => '2022-08-01 09:15:00',
            'updated_at' => '2022-08-01 09:15:00'
        ];
        DB::table('attendances')->insert($param);

        /* $param = [
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_working' => null,
            'end_working' => '2022-08-01 18:15:00',
            'created_at' => '2022-08-01 18:15:00',
            'updated_at' => '2022-08-01 18:15:00'
        ];
        DB::table('attendances')->insert($param); */

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_working' => '2022-08-01 09:20:00',
            'end_working' => null,
            'created_at' => '2022-08-01 09:20:00',
            'updated_at' => '2022-08-01 09:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_working' => null,
            'end_working' => '2022-08-01 12:20:00',
            'created_at' => '2022-08-01 18:20:00',
            'updated_at' => '2022-08-01 18:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_working' => '2022-08-01 09:25:00',
            'end_working' => null,
            'created_at' => '2022-08-01 09:25:00',
            'updated_at' => '2022-08-01 09:25:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_working' => null,
            'end_working' => '2022-08-01 18:25:00',
            'created_at' => '2022-08-01 18:25:00',
            'updated_at' => '2022-08-01 18:25:00'
        ];
        DB::table('attendances')->insert($param);

        /* $param = [
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_working' => '2022-08-01 09:15:00',
            'end_working' => null,
            'created_at' => '2022-08-01 09:15:00',
            'updated_at' => '2022-08-01 09:15:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '1',
            'date' => '2022-08-01',
            'start_working' => null,
            'end_working' => '2022-08-01 18:15:00',
            'created_at' => '2022-08-01 18:15:00',
            'updated_at' => '2022-08-01 18:15:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_working' => '2022-08-01 09:20:00',
            'end_working' => null,
            'created_at' => '2022-08-01 09:20:00',
            'updated_at' => '2022-08-01 09:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '2',
            'date' => '2022-08-01',
            'start_working' => null,
            'end_working' => '2022-08-01 18:20:00',
            'created_at' => '2022-08-01 18:20:00',
            'updated_at' => '2022-08-01 18:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_working' => '2022-08-01 09:25:00',
            'end_working' => null,
            'created_at' => '2022-08-01 09:25:00',
            'updated_at' => '2022-08-01 09:25:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'user_id' => '3',
            'date' => '2022-08-01',
            'start_working' => null,
            'end_working' => '2022-08-01 18:25:00',
            'created_at' => '2022-08-01 18:25:00',
            'updated_at' => '2022-08-01 18:25:00'
        ];
        DB::table('attendances')->insert($param); */
    }
}
