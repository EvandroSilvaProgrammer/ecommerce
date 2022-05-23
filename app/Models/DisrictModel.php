<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisrictModel extends Model
{
    protected $table = 'district_tb';

    public $timestamps = false;

    protected $fillable = [
        'name', 'province'
    ];

    // public static function district($id)
    // {
    //     return district::WHERE('province', '=', $id)->get();
    // }
}
