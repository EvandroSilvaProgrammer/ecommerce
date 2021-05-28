<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $table = 'client_contact';

    public $timestamps = false;

    protected $fillable = [
        'client_id', 'telephone'
    ];
}
