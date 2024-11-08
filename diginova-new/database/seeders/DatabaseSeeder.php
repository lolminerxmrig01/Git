<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;
use Database\Seeders\MediaSeeder;
use Database\Seeders\StateSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call('Modules\Staff\Auth\Database\seeders\StaffSeeder');
        $this->call('Modules\Customers\Auth\Database\seeders\CustomerSeeder');

        $this->call('Modules\Staff\Category\Database\seeders\CategorySeeder');
        $this->call('Modules\Staff\Brand\Database\seeders\BrandSeeder');
        $this->call('Modules\Staff\Type\Database\seeders\TypeSeeder');
        $this->call('Modules\Staff\Unit\Database\seeders\UnitSeeder');
        $this->call('Modules\Staff\Attribute\Database\seeders\AttributeSeeder');
        $this->call('Modules\Staff\Variant\Database\seeders\VariantSeeder');
        $this->call('Modules\Staff\Warranty\Database\seeders\WarrantySeeder');
//        $this->call('Modules\Staff\Product\Database\seeders\ProductSeeder');
        $this->call('Modules\Staff\Promotion\Database\seeders\PromotionSeeder');
        $this->call('Modules\Staff\Setting\Database\seeders\SettingSeeder');
        $this->call('Modules\Staff\Nav\Database\seeders\NavSeeder');
        $this->call('Modules\Staff\Slider\Database\seeders\SliderSeeder');


      $this->call(MediaSeeder::class);
        $this->call(StateSeeder::class);
    }
}
