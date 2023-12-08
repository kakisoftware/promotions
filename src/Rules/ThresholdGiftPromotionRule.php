<?php

namespace KakiSoftware\Promotions\Rules;

use App\Models\Item;
use Illuminate\Support\Collection;
use KakiSoftware\Promotions\PromotionResult;
use KakiSoftware\Promotions\RuleBase;

/**
 * The ThresholdGiftPromotionRule class is responsible for handling promotion logic where a gift
 * is offered once the total amount of the items reaches a specified threshold.
 */
class ThresholdGiftPromotionRule extends RuleBase
{
    /**
     * The apply method calculates the promotional adjustments for a given collection
     * of order items.
     */
    public function apply(Collection $orderItems): PromotionResult
    {
        $total = $orderItems->sum(fn ($orderItem) => $orderItem->price * $orderItem->quantity);

        $giftItems = new Collection;

        if ($total >= $this->parameters->get('threshold')) {
            $this->matchedItems->add($orderItems);
            $giftItems->add($this->getGiftItem());
        }

        return new PromotionResult(
            ruleName: $this->name,
            ruleDescription: $this->description,
            discountAmount: $this->discountAmount,
            matchedItems: $this->matchedItems,
            giftItems: $giftItems
        );
    }

    /**
     * Retrieves the gift item based on the gift item ID specified in the parameters.
     *
     * @return Item The gift item associated with the promotion.
     */
    protected function getGiftItem(): Item
    {
        return Item::find($this->parameters->get('gift_item_id'));
    }
}
