<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyingModel extends Model
{
    protected $table = 'supplying_tb';

    public $timestamps = false;

    protected $fillable = [
        'name', 'province', 'district', 'street', 'neighborhood', 'house_number', 'eliminado'
    ];

}
