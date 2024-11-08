<?php

namespace Modules\Staff\Category\Database\seeders;

use Illuminate\Database\Seeder;
use DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_table = __DIR__.'/../categories.sql';
        $categorizables_table = __DIR__.'/../categorizables.sql';
        DB::unprepared(file_get_contents($categories_table));
        DB::unprepared(file_get_contents($categorizables_table));
    }
}
