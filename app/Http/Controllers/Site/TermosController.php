<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;

class TermosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$servicesAll = ServiceModel::where('status', '=', 'online')->orderBy('id', 'DESC')->paginate(20);

        // DEFAULT PRO MENU
        $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no'  ");

        $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

       //$services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ");

        $requests = Pedido::where([
            'status' => 'RE',
            'client_id' => Auth::guard('client')->id()
        ])->get();

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $productsSession = [];
        if (Auth::guard('client')->check() === false)
        {
            $productsSession = session("cart");
        }
        //----

        return view('site.info.terms', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            //'services' => $services,
            'requests' => $requests,
            'productsSession' => $productsSession,
            'contacts' => $contacts,

            //'servicesAll' => $servicesAll,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
