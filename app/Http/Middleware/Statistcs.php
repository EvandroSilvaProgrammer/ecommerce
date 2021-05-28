<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Models\Statistic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admim\StatisticsController;
use Propa\BrowscapPHP\Facades\Browscap;

class Statistics
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Saves visitor data as location and browser
     *
     * @return void
     */
    public function terminate($request, $response)
    {
        $geo = json_decode(file_get_contents("http://ip-api.com/json/{$request->ip}"));
        $browser = Browscap::getBrowser();
        $stats = new Statistic();
        $stats->ip = $request->ip ?? $geo->query;
        $stats->lat = $geo->lat;
        $stats->lon = $geo->lon;
        $stats->country = $geo->country;
        $stats->region = $geo->regionName;
        $stats->city = $geo->city;
        $stats->isp = $geo->isp;

        $stats->browser = $browser->browser;
        $stats->device = $browser->device_type;

        $stats->version = $browser->version;
        $stats->platform = $browser->platform;

        $stats->year = date('Y');
        $stats->month = date('m');

        $stats->day = date('d');
        $stats->hour = date('H');

        $stats->uri = $_SERVER['REQUEST_URI'];
        $stats->referer = $_SERVER['HTTP_REFERER'] ?? 'Direct Access';


        $month = date('m');

        $acessos = DB::select(" SELECT count(id) as acessos FROM statistics WHERE ip = '$stats->ip' AND hour = '$stats->hour'
        AND uri = '$stats->uri' AND day = '$stats->day' AND month = '$month' AND year = '$stats->year' ");

        foreach($acessos as $acesso){$numeroAcessos = $acesso->acessos;}

        if($numeroAcessos == 0)
        {
            $stats->save();
        }
    }
}
