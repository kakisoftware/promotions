<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
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
