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
            'id_u' => '1',
            'date' => '2021-12-15',
            'start_working' => '2021-12-15 09:15:00',
            'end_working' => null,
            'created_at' => '2021-12-15 09:15:00',
            'updated_at' => '2021-12-15 09:15:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '1',
            'date' => '2021-12-15',
            'start_working' => null,
            'end_working' => '2021-12-15 18:15:00',
            'created_at' => '2021-12-15 18:15:00',
            'updated_at' => '2021-12-15 18:15:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-15',
            'start_working' => '2021-12-15 09:20:00',
            'end_working' => null,
            'created_at' => '2021-12-15 09:20:00',
            'updated_at' => '2021-12-15 09:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-15',
            'start_working' => null,
            'end_working' => '2021-12-15 18:20:00',
            'created_at' => '2021-12-15 18:20:00',
            'updated_at' => '2021-12-15 18:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-15',
            'start_working' => '2021-12-15 09:25:00',
            'end_working' => null,
            'created_at' => '2021-12-15 09:25:00',
            'updated_at' => '2021-12-15 09:25:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-15',
            'start_working' => null,
            'end_working' => '2021-12-15 18:25:00',
            'created_at' => '2021-12-15 18:25:00',
            'updated_at' => '2021-12-15 18:25:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '1',
            'date' => '2021-12-20',
            'start_working' => '2021-12-20 09:15:00',
            'end_working' => null,
            'created_at' => '2021-12-20 09:15:00',
            'updated_at' => '2021-12-20 09:15:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '1',
            'date' => '2021-12-20',
            'start_working' => null,
            'end_working' => '2021-12-20 18:15:00',
            'created_at' => '2021-12-20 18:15:00',
            'updated_at' => '2021-12-20 18:15:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-20',
            'start_working' => '2021-12-20 09:20:00',
            'end_working' => null,
            'created_at' => '2021-12-20 09:20:00',
            'updated_at' => '2021-12-20 09:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '2',
            'date' => '2021-12-20',
            'start_working' => null,
            'end_working' => '2021-12-20 18:20:00',
            'created_at' => '2021-12-20 18:20:00',
            'updated_at' => '2021-12-20 18:20:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-20',
            'start_working' => '2021-12-20 09:25:00',
            'end_working' => null,
            'created_at' => '2021-12-20 09:25:00',
            'updated_at' => '2021-12-20 09:25:00'
        ];
        DB::table('attendances')->insert($param);

        $param = [
            'id_u' => '3',
            'date' => '2021-12-20',
            'start_working' => null,
            'end_working' => '2021-12-20 18:25:00',
            'created_at' => '2021-12-20 18:25:00',
            'updated_at' => '2021-12-20 18:25:00'
        ];
        DB::table('attendances')->insert($param);
    }
}
