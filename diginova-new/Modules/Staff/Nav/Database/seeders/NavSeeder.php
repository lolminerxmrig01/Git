<?php

namespace Modules\Staff\Nav\Database\seeders;

use Illuminate\Database\Seeder;
use DB;


class NavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navs_table = __DIR__.'/../nav_locations.sql';
        DB::unprepared(file_get_contents($navs_table));

        $navs_table = __DIR__.'/../navs.sql';
        DB::unprepared(file_get_contents($navs_table));
    }
}
