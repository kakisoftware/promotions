<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /**
     * The table associated with the model.
     * string
     */
    protected $table = 'tenants';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
