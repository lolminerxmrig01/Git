<?php

namespace Modules\Staff\Order\Providers;

use Faker\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory as ModelFactory;

class StaffOrderServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'stafforder');

        Relation::morphMap([
          'ConsignmentHasProductVariants' => 'Modules\Staff\Order\Models\ConsignmentHasProductVariants',
          'Order' => 'Modules\Staff\Order\Models\Order',
          'OrderAddress' => 'Modules\Staff\Order\Models\OrderAddress',
          'OrderHasConsignment' => 'Modules\Staff\Order\Models\OrderHasConsignment',
        ]);
    }
}
