<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as Pedido;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $purchases = Pedido::where([
            'status' => 'EC',
        ])->orderBy('created_at', 'DESC')->get();

        dd($purchases);


        $date1 = strtotime( $purchase->updated_at );
        $date2 = strtotime(date('Y/m/d H:i'));

        $intervalo = abs( $date2 - $date1 ) / 60;



        return view('home');
    }
}
