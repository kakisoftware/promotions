<?php

namespace KakiSoftware\Promotions;

use Illuminate\Support\Collection;
use KakiSoftware\Promotions\Rules\StorewideDiscountRule;
use KakiSoftware\Promotions\Rules\ThresholdGiftPromotionRule;
use KakiSoftware\Promotions\Rules\UniformItemBulkQuantityDiscountRule;

/**
 * The RuleType enum defines the various types of promotion rules available.
 */
enum RuleType: string
{
    /**
     * Represents a storewide discount promotion rule type.
     *
     * This rule offers a percentage-based discount across all products in the store.
     * Typically used to encourage overall sales during a promotional period,
     * such as a seasonal sale or special event.
     */
    case STOREWIDE_DISCOUNT = 'STOREWIDE_DISCOUNT';

    /**
     * Represents a bulk quantity discount promotion rule type.
     *
     * This rule applies a discount when a specific bulk quantity of item's unit is purchased.
     */
    case UNIFORM_ITEM_BULK_QUANTITY_DISCOUNT = 'UNIFORM_ITEM_BULK_QUANTITY_DISCOUNT';

    /**
     * Represents a threshold gift promotion rule type.
     *
     * This rule triggers a gift or additional reward when the customer's order meets a certain threshold.
     * The threshold could be defined by a total purchase amount, quantity of items, or other criteria.
     */
    case THRESHOLD_GIFT_PROMOTION = 'THRESHOLD_GIFT_PROMOTION';

    /**
     * Creates an instance of a promotion rule based on the enum value.
     *
     * @param  string  $name The name of the promotion rule.
     * @param  string  $description A brief description of the promotion rule.
     * @param  Collection  $parameters Parameters required to instantiate the promotion rule.
     * @return RuleContract The instantiated promotion rule object.
     */
    public function toRule(string $name, string $description, Collection $parameters): RuleContract
    {
        return new (match ($this) {
            self::STOREWIDE_DISCOUNT => StorewideDiscountRule::class,
            self::UNIFORM_ITEM_BULK_QUANTITY_DISCOUNT => UniformItemBulkQuantityDiscountRule::class,
            self::THRESHOLD_GIFT_PROMOTION => ThresholdGiftPromotionRule::class,
        })($name, $description, $parameters);
    }
}
