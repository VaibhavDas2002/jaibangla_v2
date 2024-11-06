<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BenContactDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'ben_contact_details';

    protected $guarded = [];
}
