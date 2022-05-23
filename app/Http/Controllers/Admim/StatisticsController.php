<?php

namespace App\Http\Controllers\Admim;

use App\Models\Statistic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


/**
* Undocumented class
*
*
*/

class StatisticsController extends Controller
{

    public function GeneralVisits()
    {
        $generalVisits = DB::select(" SELECT count(id) as generalVisits FROM statistics  ");

        return json_encode($generalVisits);
    }

    public function OnlyVisitors()
    {
        $da = date('d');

        $query = DB::select(" SELECT DISTINCT ip as onlyVisitors FROM statistics WHERE day = {$da} GROUP BY ip  ");

        //$onlyVisitors = ['onlyVisitors' => count($query)];

        return json_encode($query);
    }

    public function UsersRegister()
    {
        $usersRegister = DB::select(" SELECT count(*) as usersRegister FROM client  ");

        return json_encode($usersRegister);
    }

    public function GeneralOnlyVisitors()
    {
        $query = DB::select(" SELECT DISTINCT ip as generalOnlyVisitors FROM statistics GROUP BY ip ");

        return json_encode($query);
    }

    /**
    * Get visit statistics today
    *
    * @return Illuminate\Http\Response;
    */
    public function visitsToday()
    {
        //min_config = config('statistics.min_hours_to_display');
        $min_config = 12;

        $time = date('H');
        $min_hours = $time > $min_config ? $time : $min_config;
        $hours = [];
        for ($i = 0; $i <= $min_hours; $i++) {
            $hours[$i] = 0;
        }

        $data = Statistic::select('hour', DB::raw('COUNT(id) as visits'))
        ->whereDate('created_at', date('Y-m-d'))
        ->groupBy('hour')
        ->orderBy('visits', 'desc')
        ->get()
        ->toArray();

        foreach ($data as $res) {
            $hours[$res['hour']] = $res['visits'];
        }

        return $hours;
    }

    /**
    * Get visit statistics for the current month
    *
    * @return Illuminate\Http\Response;
    */
    public function visitsInMonth()
    {
        //$min_config = config('statistics.min_days_to_display');
        $min_config = 12;

        $time = date('d');
        $min_days = $time > $min_config ? $time : $min_config;
        $days = [];
        for ($i = 1; $i < $min_days; $i++) {
            $days[$i] = 0;
        }

        $data = Statistic::select('day', DB::raw('COUNT(id) as visits'))
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->groupBy('day')
        ->orderBy('visits', 'desc')
        ->get()
        ->toArray();

        foreach ($data as $res) {
            $days[$res['day']] = $res['visits'];
        }

        return $days;
    }

    /**
    * Get visit statistics for the current year
    *
    * @return Illuminate\Http\Response;
    */
    public function visitsInYear()
    {
        //$min_config = config('statistics.min_months_to_display');
        $min_config = 12;

        //$labels = config('statistics.months');
        $labels = [
            1 => 'jan', 2 => 'fev', 3 => 'mar', 4 => 'abr', 5 => 'mai', 6 => 'jun',
            7 => 'jul', 8 => 'ago', 9 => 'set', 10 => 'out', 11 => 'nov', 12 => 'dez'
        ];

        $months = [];
        for ($i = 1; $i <= $min_config; $i++)
        {
            $months[$labels[$i]] = 0;
        }

        $data = Statistic::select('month', DB::raw('COUNT(id) as visits'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('visits', 'desc')
        ->get()
        ->toArray();

        foreach ($data as $res)
        {
            $months[$res['month']] = $res['visits'];
        }

        return $months;
    }

    /**
    * Get statistics of a specific data on a specific period
    *
    * @param string $column Statistics table column
    * @param string $date [today, month or year]
    * @param integer $limit
    * @return Illuminate\Http\Response;
    */
    public function columnStats($column, $date = 'today', $limit = -1)
    {
        if ($column == 'referer')
        {
            $response = [];
            $data = Statistic::select($column, DB::raw('COUNT(id) as visits'));

            if ($date == 'year') {
                $data->whereYear('created_at', date('Y'));
            } elseif ($date == 'month') {
                $data->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'));
            }else {
                $data->whereDate('created_at', date('Y-m-d'));
            }

            $data->where('referer', 'NOT LIKE', "%https://doriema.com/%")
            ->groupBy($column)
            ->limit($limit)
            ->orderBy('visits', 'desc');

            foreach ($data->get()->toArray() as $res)
            {
                $response[$res[$column]] = $res['visits'];
            }
        }

        else
        {
            $response = [];
            $data = Statistic::select($column, DB::raw('COUNT(id) as visits'));

            if ($date == 'year') {
                $data->whereYear('created_at', date('Y'));
            } elseif ($date == 'month') {
                $data->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'));
            }else {
                $data->whereDate('created_at', date('Y-m-d'));
            }

            $data->groupBy($column)
            ->limit($limit)
            ->orderBy('visits', 'desc');

            foreach ($data->get()->toArray() as $res) {
                $response[$res[$column]] = $res['visits'];
            }
        }

        if($response == [])
        {
            return
            [
                'Sem registros' => 0
            ];
        }

        return $response;
    }
}
