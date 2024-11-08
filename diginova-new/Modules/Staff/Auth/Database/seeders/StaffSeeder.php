<?php

namespace Modules\Staff\Auth\Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Staff\Auth\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'first_name' => 'Mehdi',
            'last_name' => 'Jalali',
            'email' => 'staff@diginova.test',
            'password' => Hash::make(123456),
        ]);
    }
}
