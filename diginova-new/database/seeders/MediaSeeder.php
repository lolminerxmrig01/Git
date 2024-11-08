<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media_table = __DIR__.'/../media.sql';
        DB::unprepared(file_get_contents($media_table));

        $mediables_table = __DIR__.'/../mediables.sql';
        DB::unprepared(file_get_contents($mediables_table));
    }
}
