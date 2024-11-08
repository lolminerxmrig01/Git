<?php

namespace Modules\Customers\Auth\Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Customers\Auth\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'mobile' => 9059581533,
            'email' => 'customer@diginova.test',
            'password' => Hash::make(123456),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
