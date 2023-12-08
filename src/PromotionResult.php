<?php

namespace KakiSoftware\Promotions;

use Illuminate\Support\Collection;

/**
 * The PromotionResult class encapsulates the outcome of applying a promotion rule.
 *
 * It provides a structured way to convey information about the result of a promotion,
 * including which rule was applied, the total discount amount, the items eligible for
 * the promotion, and any gift items included in the promotion.
 */
class PromotionResult
{
    /**
     * Creates a new instance of PromotionResult.
     *
     * @param  string  $ruleName The name of the promotion rule that was applied.
     * @param  string  $ruleDescription A description of the promotion rule.
     * @param  float  $discountAmount The total discount amount applied by the promotion.
     * @param  ?Collection  $matchedItems The collection of items that are eligible for the promotion.
     * @param  ?Collection  $giftItems The collection of gift items included in the promotion.
     */
    public function __construct(
        public string $ruleName,
        public string $ruleDescription,
        public float $discountAmount,
        public ?Collection $matchedItems,
        public ?Collection $giftItems
    ) {
    }
}
