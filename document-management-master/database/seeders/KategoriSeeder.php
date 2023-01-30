<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            'name' => 'Solutions'
        ]);
        DB::table('kategori')->insert([
            'name' => 'Consulting'
        ]);
        DB::table('kategori')->insert([
            'name' => 'Training'
        ]);
        DB::table('kategori')->insert([
            'name' => 'Research'
        ]);
    }
}
