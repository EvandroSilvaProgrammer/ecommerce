<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_doriema';

    public $timestamps = false;

    protected $fillable = [
        'description',
    ];
}
