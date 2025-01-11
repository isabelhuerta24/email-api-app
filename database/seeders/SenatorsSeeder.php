<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SenatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senators')->insert([
            ['name' => 'Tina Smith', 'email' => 'tina.s@example.com'],
            ['name' => 'Amy Klobuchar', 'email' => 'amy.k@example.com'],
        ]);
    }
}
