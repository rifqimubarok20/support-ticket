<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client')->insert([
            'name' => 'Bank A',
            'address' => 'Bandung',
            'contact' => '121323425'
        ]);
        DB::table('client')->insert([
            'name' => 'Bank B',
            'address' => 'Jawa Tengah',
            'contact' => '122135443'
        ]);
    }
}
