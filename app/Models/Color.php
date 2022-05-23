<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'color_tb';

    public $timestamps = false;

    protected $fillable = [
        'color',
    ];
}
