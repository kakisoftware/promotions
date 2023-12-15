<?php

namespace KakiSoftware\Promotions;

use Database\Factories\PromotionFactory;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Promotion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotions';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => RuleType::class,
        'started_at' => 'datetime:Y-m-d H:i:is',
        'ended_at' => 'datetime:Y-m-d H:i:is',
        'is_active' => 'boolean',
        'parameters' => AsCollection::class,
    ];

    /**
     * Get the parent promotionable model
     */
    public function promotionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function tag(): MorphOne
    {
        return $this->morphOne(Tag::class, 'tagable');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return PromotionFactory::new();
    }
}
