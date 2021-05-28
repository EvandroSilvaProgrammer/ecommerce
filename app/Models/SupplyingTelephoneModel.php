<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyingTelephoneModel extends Model
{
    protected $table = 'supplying_telephone_tb';

    public $timestamps = false;

    protected $fillable = [
        'supplying', 'telephone'
    ];
}
