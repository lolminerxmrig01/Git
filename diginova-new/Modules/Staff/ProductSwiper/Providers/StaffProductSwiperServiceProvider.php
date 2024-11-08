<?php

namespace Modules\Staff\ProductSwiper\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;


class StaffProductSwiperServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffProductSwiper');

        Relation::morphMap([
            'ProductSwiper' => 'Modules\Staff\Attribute\Models\ProductSwiper',
        ]);
    }
}
