<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoordBancarias extends Model
{
    protected $table = 'coord_bancarias';

    public $timestamps = false;

    protected $fillable = [
        'banc', 'iban',
    ];
}
