<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    protected $connection = 'pgsql_ifsc';
    protected $table = 'bank_details';      
    protected $primaryKey='ifsc';
    public $timestamps = false;
}
