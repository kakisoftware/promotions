<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use KakiSoftware\Promotions\Promotionable;

class Store extends Model
{
    use Promotionable;

    /**
     * The table associated with the model.
     * string
     */
    protected $table = 'stores';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
