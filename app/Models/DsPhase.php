<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DsPhase extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'm_ds_phase';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
