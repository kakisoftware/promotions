<?php

use Illuminate\Support\Collection;
use KakiSoftware\Promotions\Promotion;
use KakiSoftware\Promotions\PromotionManager;
use Workbench\App\Models\Store;

beforeEach(function () {
    Promotion::factory()->for(Store::create(), 'promotionable')->storewideDiscount()->create();
    $this->promotions = new Collection;
    $this->promotionRules = PromotionManager::load();
});

it('storewide discount', function () {
    $items = new Collection;
    $items->add(json_decode(json_encode([
        'price' => 100.00,
        'quantity' => 2,
    ])));

    foreach ($this->promotionRules as $rule) {
        $this->promotions->add($rule->apply($items));
    }

    $discountItemsCount = $this->promotions->sum(fn ($promotion) => $promotion->matchedItems->count());
    $discountTotalAmount = $this->promotions->sum(fn ($promotion) => $promotion->discountAmount);

    expect($discountItemsCount)->toEqual(1)
        ->and($discountTotalAmount)->toEqual(40);
});
