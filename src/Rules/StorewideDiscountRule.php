<?php

namespace KakiSoftware\Promotions\Rules;

use Illuminate\Support\Collection;
use KakiSoftware\Promotions\PromotionResult;
use KakiSoftware\Promotions\RuleBase;

/**
 * The StorewideDiscountRule class applies a uniform discount rate to all items
 * in a store.
 */
class StorewideDiscountRule extends RuleBase
{
    /**
     * The apply method calculates the promotional adjustments for a given collection
     * of order items.
     *
     * @return PromotionResult An object containing details of the applied promotion rule.
     */
    public function apply(Collection $orderItems): PromotionResult
    {
        $total = $orderItems->sum(fn ($orderItem) => $orderItem->price * $orderItem->quantity);

        $this->discountAmount = round($total * $this->getDiscountRate($this->parameters->get('discount')));

        return new PromotionResult(
            ruleName: $this->name,
            ruleDescription: $this->description,
            discountAmount: $this->discountAmount,
            matchedItems: $orderItems,
            giftItems: new Collection,
        );
    }
}
