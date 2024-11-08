<?php

namespace Modules\Staff\Brand\Providers;

use Faker\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory as ModelFactory;



class StaffBrandServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffbrand');

        Relation::morphMap([
            'Brand' => 'Modules\Staff\Brand\Models\Brand',
        ]);
    }

}
