<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'origin', 'destination','currency', 'twenty','forty', 'fortyhc','contract_id'
    ];

}
