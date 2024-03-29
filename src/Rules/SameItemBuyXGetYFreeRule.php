<?php

namespace KakiSoftware\Promotions\Rules;

use Illuminate\Support\Collection;
use KakiSoftware\Promotions\PromotionResult;
use KakiSoftware\Promotions\RuleBase;

/**
 * The UniformItemBulkQuantityDiscountRule class is a promotion rule that applies a discount
 * to orders where a specific quantity of uniform items is purchased. This rule is particularly
 * used for offering discounts on bulk purchases of the same item type or unit (e.g., two boxes
 * of the same product).
 *
 * It calculates a discount based on the total amount of the items that meet the bulk quantity
 * criteria, such as any two boxes, and applies a uniform discount rate to these items.
 */
class SameItemBuyXGetYFreeRule extends RuleBase
{
    /**
     * The apply method calculates the promotional adjustments for a given collection
     * of order items.
     *
     * TODO: Should check same sku for item bulks
     *
     * @return PromotionResult An object containing details of the applied promotion rule.
     */
    public function apply(Collection $orderItems): PromotionResult
    {
        foreach ($orderItems as $orderItem) {
            //            $itemTaggedPromotionTags = $orderItem->item->promotionTags->map(fn ($promotionTag) => $promotionTag->tag);
            $itemTaggedPromotionTags = $orderItem->item->validPromotions()->map(fn ($promotionTag) => $promotionTag->tag);

            if ($itemTaggedPromotionTags->intersect($this->tags)->count() > 0
                && $orderItem->quantity >= $this->parameters->get('threshold')
            ) {
                $this->matchedItems->add($orderItems);
                for ($i = 0; $i < $this->parameters->get('gift_quantity'); $i++) {
                    $this->giftItems->add($orderItem->item);
                }
            }
        }

        return new PromotionResult(
            ruleName: $this->name,
            ruleDescription: $this->description,
            discountAmount: $this->discountAmount,
            matchedItems: $this->matchedItems,
            giftItems: $this->giftItems,
        );
    }
}
