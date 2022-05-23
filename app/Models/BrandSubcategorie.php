<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSubcategorie extends Model
{
    protected $table = 'brand_subcategorie_tb';

    public $timestamps = false;

    protected $fillable = [
        'brand', 'subcategorie'
    ];
}
