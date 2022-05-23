<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    protected $table = 'province_tb';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
