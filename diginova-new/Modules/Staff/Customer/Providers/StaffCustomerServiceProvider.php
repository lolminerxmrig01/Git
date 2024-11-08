<?php

namespace Modules\Staff\Customer\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class StaffCustomerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffcustomer');

        Relation::morphMap([
          'Customer' => 'Modules\Customers\Auth\Models\Customer',
          'CustomerAddress' => 'Modules\Staff\Customer\Models\CustomerAddress',
        ]);
    }

}
