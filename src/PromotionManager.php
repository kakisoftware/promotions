<?php

namespace KakiSoftware\Promotions;

use Illuminate\Support\Facades\Facade;

/**
 * The PromotionManager class provides a facade for accessing the RuleFactory.
 *
 * @see \Illuminate\Support\Facades\Facade
 */
class PromotionManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * This method returns the service container binding key for the RuleFactory,
     * allowing the facade to resolve the underlying instance of the factory.
     *
     * @return string The name of the facade accessor.
     */
    protected static function getFacadeAccessor()
    {
        return RuleFactory::class;
    }
}
