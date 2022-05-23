<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table = 'contacts_doriema';

    public $timestamps = false;

    protected $fillable = [
        'phone_number', 'email', 'adress',
    ];
}
