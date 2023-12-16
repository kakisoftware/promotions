<?php

namespace KakiSoftware\Promotions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionTag extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotion_tags';

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }
}
