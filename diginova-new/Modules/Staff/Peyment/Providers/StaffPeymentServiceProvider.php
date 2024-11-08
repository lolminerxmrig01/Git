<?php

namespace Modules\Staff\Peyment\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;


class StaffPeymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/peymentMethod.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffpeyment');

        Relation::morphMap([
            'PeymentMethod' => 'Modules\Staff\Peyment\Models\PeymentMethod',
        ]);

    }

}
