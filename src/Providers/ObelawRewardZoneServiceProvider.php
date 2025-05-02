<?php

namespace Obelaw\RewardZone\Providers;

use Illuminate\Support\ServiceProvider;

class ObelawRewardZoneServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/rewardzone.php',
            'obelaw.rewardzone'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/rewardzone.php' => config_path('obelaw/rewardzone.php'),
            ]);
        }
    }
}
