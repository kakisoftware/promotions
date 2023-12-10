<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The table associated with the model.
     * string
     */
    protected $table = 'items';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
