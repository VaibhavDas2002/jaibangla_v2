<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BenPersonalDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'ben_personal_details';
    
    protected $guarded = [];
}
