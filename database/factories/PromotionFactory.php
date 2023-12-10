<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KakiSoftware\Promotions\Promotion;
use KakiSoftware\Promotions\RuleType;
use Workbench\App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\KakiSoftware\Promotions\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    /**
     * Indicate that the type is STOREWIDE_DISCOUNT
     */
    public function storewideDiscount(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'type' => RuleType::STOREWIDE_DISCOUNT->value,
            'name' => '全館8折',
            'description' => '新店開幕慶',
            'started_at' => '2023-12-01 00:00:00',
            'ended_at' => '2023-12-30 23:59:59',
            'is_active' => true,
            'parameters' => ['discount' => 80],
        ]);
    }

    public function buildQuantityDiscount(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'type' => RuleType::UNIFORM_ITEM_BULK_QUANTITY_DISCOUNT->value,
            'name' => '同商品任 2 箱結帳 88 折',
            'description' => '熱銷飲品 限時優惠',
            'started_at' => '2023-12-01 00:00:00',
            'ended_at' => '2023-12-30 23:59:59',
            'is_active' => true,
            'parameters' => ['unit_id' => 'box', 'threshold' => 2, 'discount' => 88],
        ]);
    }

    public function thresholdGiftPromotion(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'type' => RuleType::THRESHOLD_GIFT_PROMOTION->value,
            'name' => '滿額大好禮',
            'description' => '滿2000，送好禮',
            'started_at' => '2023-12-01 00:00:00',
            'ended_at' => '2023-12-30 23:59:59',
            'is_active' => true,
            'parameters' => ['threshold' => 2000, 'gift_item_id' => Item::create()->create()->id],
        ]);
    }
}
