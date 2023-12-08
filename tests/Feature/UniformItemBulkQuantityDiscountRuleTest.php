<?php

use Illuminate\Support\Collection;
use KakiSoftware\Promotions\Promotion;
use KakiSoftware\Promotions\PromotionManager;

beforeEach(function () {
    Promotion::factory()->buildQuantityDiscount()->create();

    $this->promotions = new Collection;
    $this->promotionRules = PromotionManager::load();
});

describe('uniform item bulk quantity discount', function () {
    it('match the item bulk quantity', function () {
        $items = new Collection;
        $items->add(json_decode(json_encode(['unit_id' => 'box', 'price' => 400.00, 'quantity' => 3])));
        $items->add(json_decode(json_encode(['unit_id' => 'pill', 'price' => 4.00, 'quantity' => 2])));
        $items->add(json_decode(json_encode(['unit_id' => 'box', 'price' => 200.00, 'quantity' => 2])));

        foreach ($this->promotionRules as $rule) {
            $this->promotions->add($rule->apply($items));
        }

        $discountItemsCount = $this->promotions->sum(fn ($promotion) => $promotion->matchedItems->count());
        $discountTotalAmount = $this->promotions->sum(fn ($promotion) => $promotion->discountAmount);

        expect($discountItemsCount)->toEqual(2)
            ->and($discountTotalAmount)->toEqual(144);
    });

    it('does not match the item bulk quantity', function () {
        $items = new Collection;
        $items->add(json_decode(json_encode(['unit_id' => 'box', 'price' => 400.00, 'quantity' => 1])));
        $items->add(json_decode(json_encode(['unit_id' => 'pill', 'price' => 4.00, 'quantity' => 2])));
        $items->add(json_decode(json_encode(['unit_id' => 'box', 'price' => 200.00, 'quantity' => 1])));

        foreach ($this->promotionRules as $rule) {
            $this->promotions->add($rule->apply($items));
        }

        $discountItemsCount = $this->promotions->sum(fn ($promotion) => $promotion->matchedItems->count());
        $discountTotalAmount = $this->promotions->sum(fn ($promotion) => $promotion->discountAmount);

        expect($discountItemsCount)->toEqual(0)
            ->and($discountTotalAmount)->toEqual(0);
    });
});
