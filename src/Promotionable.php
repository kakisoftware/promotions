<?php

namespace KakiSoftware\Promotions;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Promotionable
{
    /**
     * Get the promotion
     */
    public function promotions(): MorphMany
    {
        return $this->morphMany(Promotion::class, 'promotionable');
    }
}
