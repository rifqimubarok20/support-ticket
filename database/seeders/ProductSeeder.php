<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'nama' => 'Aplikasi TKB',
            'id_kategori' => '1',
            'client_id' => '1'
        ]);

        DB::table('product')->insert([
            'nama' => 'Aplikasi PRC',
            'id_kategori' => '1',
            'client_id' => '2'
        ]);

        DB::table('product')->insert([
            'nama' => 'Aplikasi TKB',
            'id_kategori' => '1',
            'client_id' => '2'
        ]);
    }
}
