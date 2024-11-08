<?php

namespace Modules\Staff\Attribute\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;


class StaffAttributeServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'staffattribute');

        Relation::morphMap([
            'AttributeGroups' => 'Modules\Staff\Attribute\Models\AttributeGroup',
            'Attribute' => 'Modules\Staff\Attribute\Models\Attribute',
        ]);
    }
}
