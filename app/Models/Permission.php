<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
