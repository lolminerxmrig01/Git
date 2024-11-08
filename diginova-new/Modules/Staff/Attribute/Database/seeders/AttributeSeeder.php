<?php

namespace Modules\Staff\Attribute\Database\seeders;

use Illuminate\Database\Seeder;
use DB;


class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute_groups = __DIR__.'/../attribute_groups.sql';
        $attribute_values = __DIR__.'/../attribute_values.sql';
        $attributes = __DIR__.'/../attributes.sql';

        DB::unprepared(file_get_contents($attribute_groups));
        DB::unprepared(file_get_contents($attributes));
        DB::unprepared(file_get_contents($attribute_values));
    }
}
