<?php

namespace Modules\Staff\Slider\Database\seeders;

use Illuminate\Database\Seeder;
use DB;


class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider_groups_table = __DIR__.'/../slider_groups.sql';
        DB::unprepared(file_get_contents($slider_groups_table));

        $sliders_table = __DIR__.'/../sliders.sql';
        DB::unprepared(file_get_contents($sliders_table));

        $slider_images_table = __DIR__.'/../slider_images.sql';
        DB::unprepared(file_get_contents($slider_images_table));
    }
}
