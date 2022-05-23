<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    protected $table = 'product_detail_tb';

    public $timestamps = false;

    protected $fillable = [
        'description', 'info', 'product'
    ];
}
