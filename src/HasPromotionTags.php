<?php

namespace KakiSoftware\Promotions;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPromotionTags
{
    /**
     * Get the promotion
     */
    public function promotionTags(): MorphMany
    {
        return $this->morphMany(PromotionTaggedModel::class, 'taggable');
    }
}
