<?php

namespace Modules\Staff\Shiping\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;


class StaffShipingServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__ . '/../Routes/deliveryMethod.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffdelivery');

        Relation::morphMap([
            'DeliveryMethod' => 'Modules\Staff\Shiping\Models\DeliveryMethod',
        ]);

    }

}
