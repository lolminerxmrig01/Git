<?php

namespace Modules\Staff\Rating\Database\seeders;

use Illuminate\Database\Seeder;
use DB;


class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = __DIR__.'/../ratings.sql';
        DB::unprepared(file_get_contents($ratings));
    }
}
