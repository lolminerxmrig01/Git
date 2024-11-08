<?php

namespace Modules\Staff\Slider\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;


class StaffSliderServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffslider');

        Relation::morphMap([
            'Slider' => 'Modules\Staff\Slider\Models\Slider',
            'SliderImage' => 'Modules\Staff\Slider\Models\SliderImage',
        ]);
    }

}
