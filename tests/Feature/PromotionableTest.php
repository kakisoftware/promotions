<?php

use KakiSoftware\Promotions\Promotion;
use Workbench\App\Models\Store;
use Workbench\App\Models\Tenant;

describe('promotionable', function () {
    it('Tenant has promotions, Store does not have any.', function () {
        $tenant = Tenant::create();
        $store = Store::create();

        Promotion::factory()->storewideDiscount()->for($tenant, 'promotionable')->create();

        expect($tenant->promotions->count())->toEqual(1)
            ->and($store->promotions->count())->toEqual(0);
    });
});
