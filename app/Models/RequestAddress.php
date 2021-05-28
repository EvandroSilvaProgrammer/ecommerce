<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestAddress extends Model
{
    public $timestamps = false;

    protected $table = 'request_address';

    protected $fillable = [
        'request_id', 'province', 'district', 'street', 'neighborhood', 'house_number'
    ];

}
