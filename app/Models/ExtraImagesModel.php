<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraImagesModel extends Model
{
    protected $table = 'extra_images_product_tb';

    public $timestamps = false;

    protected $fillable = [
        'image', 'product'
    ];
}
