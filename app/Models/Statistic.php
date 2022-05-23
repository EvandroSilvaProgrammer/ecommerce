<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $guarded = [];

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function getMonthAttribute($value)
    {
        // $months = config('statistics.months');

        $months = [
            1 => 'jan', 2 => 'fev', 3 => 'mar', 4 => 'abr', 5 => 'mai', 6 => 'jun',
            7 => 'jul', 8 => 'ago', 9 => 'set', 10 => 'out', 11 => 'nov', 12 => 'dez'
        ];


        return $months[$value];
    }
}
