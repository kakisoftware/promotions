<?php

namespace KakiSoftware\Promotions;

use Illuminate\Support\Collection;

/**
 * The RuleContract interface defines a standard structure for implementing
 * different promotion rules in an application.
 */
interface RuleContract
{
    /**
     * The apply method calculates the promotional adjustments for a given collection
     * of order items.
     */
    public function apply(Collection $orderItems): PromotionResult;
}
