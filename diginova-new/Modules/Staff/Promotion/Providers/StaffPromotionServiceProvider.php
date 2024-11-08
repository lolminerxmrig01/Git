<?php

namespace Modules\Staff\Promotion\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class StaffPromotionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/periodicPrices.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/campains.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffpromotion');

        Relation::morphMap([
            'Promotion' => 'Modules\Staff\Promotion\Models\Promotion',
            'Campain' => 'Modules\Staff\Promotion\Models\Campain',
        ]);
    }

}
