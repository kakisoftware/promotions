<?php

namespace KakiSoftware\Promotions;

use Illuminate\Support\Collection;

/**
 * The RuleBase class serves as an abstract base for different types of
 * promotion rules. It implements the RuleContract and provides common
 * functionality and properties that are shared across various promotion rule
 * implementations.
 */
abstract class RuleBase implements RuleContract
{
    /**
     * A collection to store items that match the promotion criteria.
     */
    protected Collection $matchedItems;

    /**
     * A collection to store gift items associated with the promotion.
     */
    protected Collection $giftItems;

    /**
     * The total discount amount calculated by the promotion rule.
     */
    protected float $discountAmount;

    /**
     * Creates a new instance of a promotion rule.
     *
     * @param  string  $name The name of the promotion rule.
     * @param  string  $description A brief description of the promotion rule.
     * @param  Collection  $parameters A collection of parameters specific to the promotion rule.
     */
    public function __construct(
        public string $name,
        public string $description,
        public Collection $parameters,
    ) {
        $this->matchedItems = new Collection;
        $this->giftItems = new Collection;
        $this->discountAmount = 0.0;
    }

    /**
     * Calculates the discount rate from a given discount percentage.
     *
     * @param  int|float|string  $discount The discount percentage.
     * @return float The calculated discount rate.
     */
    public function getDiscountRate(int|float|string $discount): float
    {
        return 1 - ($discount / 100);
    }
}
