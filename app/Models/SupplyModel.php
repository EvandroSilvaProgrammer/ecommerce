<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyModel extends Model
{
    protected $table = 'supply_tb';

    public $timestamps = false;

    protected $fillable = [
        'supplying', 'date', 'pdf', 'total_value', 'total_items', 'status', 'eliminado'
    ];
}
