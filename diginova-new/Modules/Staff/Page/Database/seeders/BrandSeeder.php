<?php

namespace Modules\Staff\Brand\Database\seeders;

use Illuminate\Database\Seeder;
use Modules\Staff\Brand\Models\Brand;
use Modules\Staff\Category\Models\Categorizable;



class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $brands = ['سامسونگ', 'ال جی', 'هواوی', 'پاناسونیک', 'بوش', 'آدیداس', 'پوما', 'نایک', 'پاکشوما', 'نوکیا', 'اپل', 'ایسوس', 'ایسر', 'لنوو'];
//        for($i = 0; $i++; $i <= (count($brands) - 1))
//        {
//            $add_brand = Brand::insert([
//                'name' => "برند ",
//                'en_name' => "brand $brands[$i]",
//                'description' => 'تست',
//                'type' => rand(0,1),
//                'slug' => 'samsung',
//            ]);
//
//            Categorizable::insert([
//                'category_id' => rand(0,1),
//                'categorizable_type' => 'brands',
//                'categorizable_id' => $add_brand->id,
//            ]);
//        }
    }
}
