<?php

namespace Modules\Customers\Front\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
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

      $this->loadViewsFrom(__DIR__.'/../Resources/views', 'front');

      Relation::morphMap([
        'Cart' => 'Modules\Customers\Front\Models\Cart',
      ]);
    }
}
