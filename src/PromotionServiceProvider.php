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
        $this->app->bind(RuleFactory::class, fn () => new RuleFactory);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
