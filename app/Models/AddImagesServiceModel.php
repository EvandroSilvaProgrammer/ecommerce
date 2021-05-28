<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddImagesServiceModel extends Model
{
    protected $table = 'extra_images_service_tb';

    public $timestamps = false;

    protected $fillable = [
        'image', 'service'
    ];
}
