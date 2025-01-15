<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name'=>'Anna',
            'last_name'=>'Sancho',
            'middle_initial'=>'B',
            'student_No'=>'25-0001',
            'age'=>'25',
            'address'=>'Malasiqui,Pangasinan',
            'username'=>'admin',
            'password'=>Hash::make('useradmin'),
            'role'=>'admin',
        ]);
    }
}
