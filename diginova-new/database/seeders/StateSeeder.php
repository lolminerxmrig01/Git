<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state_table = __DIR__.'/../states.sql';
        DB::unprepared(file_get_contents($state_table));

        $zonables_table = __DIR__.'/../zonables.sql';
        DB::unprepared(file_get_contents($zonables_table));
    }
}
