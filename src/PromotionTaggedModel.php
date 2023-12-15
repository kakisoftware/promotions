<?php

namespace KakiSoftware\Promotions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PromotionTaggedModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotion_tagged_models';

    public function promotionTaggable(): MorphTo
    {
        return $this->morphTo();
    }
}
