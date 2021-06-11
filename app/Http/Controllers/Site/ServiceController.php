<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceModel;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, ServiceModel $service)
    {
        $this->request = $request;
        $this->repository = $service;
    }

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

        return view('site.services.showServices', [
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
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)
        {
            $service = ServiceModel::find($id);

            if (!$service || $service->eliminado == 'yes') {
                return redirect()->back();
            }

            //$servicesAll = ServiceModel::where('status', '=', 'online')->orderBy('id', 'DESC')->get();

            $extraImages = DB::select("SELECT id, image, service FROM extra_images_service_tb WHERE service={$id}");

            // DEFAULT PRO MENU
            $brands = DB::select(" SELECT * FROM product_brand_tb ");

            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no'  ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

            //$services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

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

            return view('site.services.showService', [
                //'services' => $services,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'requests' => $requests,
                'productsSession'  => $productsSession,

                'service' => $service,
                //'servicesAll' => $servicesAll,
                'extraImages' => $extraImages,
                'contacts' => $contacts,
                ]);
            }
        }
