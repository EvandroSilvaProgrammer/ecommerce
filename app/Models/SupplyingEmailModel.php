<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplyingEmailModel extends Model
{
    protected $table = 'supplying_email_tb';

    public $timestamps = false;

    protected $fillable = [
        'supplying', 'email'
    ];
}
