<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    protected $table = 'percent';

    public $timestamps = false;

    protected $fillable = [
        'percent'
    ];
}
