<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use KakiSoftware\Promotions\Promotion;
use KakiSoftware\Promotions\PromotionManager;

beforeEach(function () {
    $item = new class extends Model
    {
        public $id = 99;
    };

    $mockItem = Mockery::mock('alias:App\Models\Item');
    $mockItem->shouldReceive('find')->with($item->id)->andReturn($item);
    Config::set('promotion.models.item', get_class($mockItem));

    $this->promotion = Promotion::factory()->thresholdGiftPromotion($item)->create();
    $this->promotions = new Collection;
    $this->promotionRules = PromotionManager::load();
});

describe('threshold gift promotion', function () {
    it('match the threshold', function () {
        $items = new Collection;
        $items->add(json_decode(json_encode(['unit_id' => 'box', 'price' => 400.00, 'quantity' => 10])));

        foreach ($this->promotionRules as $rule) {
            $this->promotions->add($rule->apply($items));
        }

        $discountItemsCount = $this->promotions->sum(fn ($promotion) => $promotion->matchedItems->count());
        $discountTotalAmount = $this->promotions->sum(fn ($promotion) => $promotion->discountAmount);
        $giftItems = $this->promotions->first()->giftItems;

        expect($discountItemsCount)->toEqual(1)
            ->and($discountTotalAmount)->toEqual(0)
            ->and($giftItems->count())->toEqual(1)
            ->and($giftItems->first()->id)->toEqual($this->promotion->parameters['gift_item_id']);
    });

    it('does not match the threshold', function () {
        $items = new Collection;
        $items->add(json_decode(json_encode(['unit_id' => 'box', 'price' => 400.00, 'quantity' => 1])));

        foreach ($this->promotionRules as $rule) {
            $this->promotions->add($rule->apply($items));
        }

        $discountItemsCount = $this->promotions->sum(fn ($promotion) => $promotion->matchedItems->count());
        $discountTotalAmount = $this->promotions->sum(fn ($promotion) => $promotion->discountAmount);
        $giftItems = $this->promotions->first()->giftItems;

        expect($discountItemsCount)->toEqual(0)
            ->and($discountTotalAmount)->toEqual(0)
            ->and($giftItems->count())->toEqual(0);
    });
});
