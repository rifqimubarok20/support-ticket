<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Haikal',
            'email' => 'haikal@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456'),
            'role' => 'programmer',
        ]);

        DB::table('users')->insert([
            'name' => 'Rifqi',
            'email' => 'rifqi@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456'),
            'role' => 'programmer',
        ]);

        DB::table('users')->insert([
            'name' => 'Arif',
            'email' => 'arif@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456'),
            'role' => 'client',
        ]);
    }
}
