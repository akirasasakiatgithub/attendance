<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
            'email' => 'tony123@gmail.com',
            'password' => 'DVFAsdfvsd'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'jack',
            'email' => 'jack123@gmail.com',
            'password' => 'SDFAfffs455'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'sara',
            'email' => 'sara123@gmail.com',
            'password' => 'DSF4432fee'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'saly',
            'email' => 'saly123@gmail.com',
            'password' => 'VSDFgrg5665'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'ryoichi',
            'email' => 'ryoichi123@gmail.com',
            'password' => 'VDFmhyj675'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'toki',
            'email' => 'toki123@gmail.com',
            'password' => 'VEVERFgrvf564'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'yasuyo',
            'email' => 'yasuyo123@gmail.com',
            'password' => 'EVVDD54rf4'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'ippei',
            'email' => 'ippei123@gmail.com',
            'password' => 'VDSFFDgrfbf5645'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'mina',
            'email' => 'mina123@gmail.com',
            'password' => 'FDGrvgtf65565'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'yuka',
            'email' => 'yuka123@gmail.com',
            'password' => 'FGRBRBrffrgg565'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'jun',
            'email' => 'jun123@gmail.com',
            'password' => 'VVJYtffh45'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'ryou',
            'email' => 'ryou123@gmail.com',
            'password' => 'JRTGH6h87f'
        ];
        DB::table('users')->insert($param);
    }
}
