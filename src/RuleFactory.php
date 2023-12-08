<?php

namespace KakiSoftware\Promotions;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * The RuleFactory class is responsible for loading and creating
 * promotion rule objects based on the active promotions from the database.
 */
class RuleFactory
{
    /**
     * Load and create rule objects for all active promotions.
     *
     * @return Collection A collection of instantiated promotion rule objects.
     */
    public function load(): Collection
    {
        $today = Carbon::now();

        return Promotion::query()
            ->where('started_at', '<=', $today)
            ->where('ended_at', '>=', $today)
            ->where('is_active', true)
            ->get()
            ->map(fn ($promotion) => $this->make($promotion));
    }

    /**
     * Instantiate a promotion rule object from a Promotion model instance.
     *
     * @param  Promotion  $promotion The promotion model instance.
     * @return RuleContract The instantiated promotion rule object.
     */
    private function make(Promotion $promotion): RuleContract
    {
        $name = $promotion->name;
        $description = $promotion->description;
        $parameters = $promotion->parameters;

        return $promotion->type->toRule($name, $description, $parameters);
    }
}
