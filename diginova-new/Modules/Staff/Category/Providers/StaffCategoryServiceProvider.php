<?php

namespace Modules\Staff\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Illuminate\Database\Eloquent\Relations\Relation;


class StaffCategoryServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffcategory');

        Relation::morphMap([
            'Category' => 'Modules\Staff\Category\Models\Category',
        ]);
    }
}
