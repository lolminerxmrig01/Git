<?php

namespace Modules\Staff\Variant\Database\seeders;

use Illuminate\Database\Seeder;
use DB;


class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variant_groups_table = __DIR__ . '/../variant_groups.sql';
        DB::unprepared(file_get_contents($variant_groups_table));

        $variants_table = __DIR__ . '/../variants.sql';
        DB::unprepared(file_get_contents($variants_table));
    }
}
