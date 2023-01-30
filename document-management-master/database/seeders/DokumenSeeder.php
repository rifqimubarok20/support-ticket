<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            'name' => 'BPP'
        ]);
        DB::table('documents')->insert([
            'name' => 'FSD'
        ]);
        DB::table('documents')->insert([
            'name' => 'BRD'
        ]);
        DB::table('documents')->insert([
            'name' => 'UAT Script'
        ]);
        DB::table('documents')->insert([
            'name' => 'BAST'
        ]);
    }
}
