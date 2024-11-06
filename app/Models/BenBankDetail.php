<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BenBankDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'ben_bank_details';

    protected $guarded = [];
}
