<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table = 'service_tb';

    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'price', 'discount', 'image', 'status', 'eliminado'
    ];
}
