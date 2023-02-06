<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project')->insert([
            'client_id' => '1',
            'product_id' => '1',
            'start_project' => '2023-02-03',
            'finish_project' => '2023-02-23',
        ]);

        DB::table('project')->insert([
            'client_id' => '2',
            'product_id' => '1',
            'start_project' => '2023-02-10',
            'finish_project' => '2023-02-25',
        ]);

        DB::table('project')->insert([
            'client_id' => '2',
            'product_id' => '2',
            'start_project' => '2023-02-15',
            'finish_project' => '2023-02-28',
        ]);
    }
}
