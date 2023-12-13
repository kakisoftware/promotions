<?php

namespace KakiSoftware\Promotions;

use Illuminate\Support\ServiceProvider;

class PromotionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/promotion.php', 'promotion');

        $this->app->bind(RuleFactory::class, fn () => new RuleFactory);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
