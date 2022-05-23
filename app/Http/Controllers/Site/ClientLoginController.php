<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterClientRequest;
use App\Http\Requests\RegisterClientRequest2;

use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\ClientContact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Session;
use App\Models\RequestProduct;

class ClientLoginController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Client $client)
    {
        $this->request = $request;
        $this->repository = $client;
    }


    public function showRegister()
    {
        $provinces = DB::select("SELECT * FROM province_tb");
        $districts = DB::select("SELECT * FROM district_tb");

        // DEFAULT PRO MENU
            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ASC ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ORDER BY product_subcategorie_tb.name ASC ");

       // $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ");

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

        return view('site.client.clientRegister2',
        [
            'provinces' => $provinces,
            'districts' => $districts,

            'categories' => $categories,
            'subcategories' => $subcategories,
           // 'services' => $services,
            'requests' => $requests,
            'productsSession' => $productsSession,
            'contacts' => $contacts,
        ]);
    }

    public function getDistricts(Request $request, $id)
    {
        if($request->ajax())
        {
            $districts = DB::select("SELECT * FROM district_tb WHERE province={$id}");
            return response()->json($districts);
        }
    }

    public function register(RegisterClientRequest $request)
    {
        if($request->password != $request->confirm_password)
        {
            $request->session()->flash('passwordError', "As senhas diferem!");
            return redirect()->back()->withInput();
        }

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        $this->repository->create($data);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('client')->attempt($credentials))
        {
            if (session()->has('cart'))
            {
                $clientID = Auth::guard('client')->id();

                $requestID = Pedido::queryID([
                    'client_id' => $clientID,
                    'status' => 'RE',
                ]);

                if(empty($requestID))
                {
                    $newRequest = Pedido::create([
                        'client_id' => $clientID,
                        'status' => 'RE',
                        'time' => date('H:i:s'),
                    ]);

                    $requestID = $newRequest->id;
                }

                foreach( Session::get("cart") as $key => $item  )
                {
                    $verification = RequestProduct::where('request_id', $requestID)->where('product_id', '=', $item['id'])->where('status', '=', 'RE')->get();

                    if( $verification->count() != 0 )
                    {
                        foreach($verification as $vf)
                        { $vf->qtd; }

                        DB::select("UPDATE request_product SET qtd = $vf->qtd+{$item['qtd']} WHERE request_id = {$requestID}
                        AND product_id = {$item['id']} AND status = 'RE' ");
                    }
                    else
                    {
                        RequestProduct::create([
                            'request_id' => $requestID,
                            'product_id' => $item['id'],
                            'value' => $item['new_price'],
                            'status' => 'RE',
                            'qtd' => $item['qtd'],
                            'color' => 'default',
                            'time' => date('H:i:s'),
                        ]);
                    }
                }
                session()->forget('cart');
            }
            return redirect()->route('sendEmail.newClient');
        }

        return redirect()->route('products.showHome');
    }

    public function updateRegister(RegisterClientRequest2 $request)
    {
        $clientID = Auth::guard('client')->id();

        Client::where('id', '=', $clientID)
        ->update([
            'telephone' => $request->telephone,
            'province' => $request->province,
            'district' => $request->district,
            'neighborhood' => $request->neighborhood,
            'street' => $request->street,
            'house_number' => $request->house_number,
        ]);

        ClientContact::create([
            'client_id' => $clientID,
            'telephone' => $request->telephone2,
        ]);

        return redirect()->route('shopCart.checkout');
    }

    public function showLogin()
    {
        return view('site.client.clientLogin');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('client')->attempt($credentials))
        {
            if (session()->has('cart'))
            {
                $clientID = Auth::guard('client')->id();

                $requestID = Pedido::queryID([
                    'client_id' => $clientID,
                    'status' => 'RE',
                ]);

                if(empty($requestID))
                {
                    $newRequest = Pedido::create([
                        'client_id' => $clientID,
                        'status' => 'RE',
                        'time' => date('H:i:s'),
                    ]);

                    $requestID = $newRequest->id;
                }

                foreach( Session::get("cart") as $key => $item  )
                {
                    $verification = RequestProduct::where('request_id', $requestID)->where('product_id', '=', $item['id'])->where('status', '=', 'RE')->get();

                    if( $verification->count() != 0 )
                    {
                        foreach($verification as $vf)
                        { $vf->qtd; }

                        DB::select("UPDATE request_product SET qtd = $vf->qtd+{$item['qtd']} WHERE request_id = {$requestID}
                        AND product_id = {$item['id']} AND status = 'RE' ");
                    }
                    else
                    {
                        RequestProduct::create([
                            'request_id' => $requestID,
                            'product_id' => $item['id'],
                            'value' => $item['new_price'],
                            'status' => 'RE',
                            'qtd' => $item['qtd'],
                            'color' => 'default',
                            'time' => date('H:i:s'),
                        ]);
                    }
                }
                session()->forget('cart');
            }
            return redirect()->route('products.showHome');
        }

        $request->session()->flash('loginError', "Os dados não conferem!");
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::guard('client')->logout();

        return redirect()->route('products.showHome');
    }

    public function profileClient()
    {
        $client = Client::find(Auth::guard('client')->id());

        $telephone2 = ClientContact::where('client_id', Auth::guard('client')->id())->first();

        $provinces = DB::select("SELECT * FROM province_tb");
        $districts = DB::select("SELECT * FROM district_tb");

        // DEFAULT PRO MENU
            $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_subcategorie_tb.categorie = product_categorie_tb.id
            AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ASC ");

            $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
            WHERE product_tb.subcategorie = product_subcategorie_tb.id
            AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ORDER BY product_subcategorie_tb.name ASC ");

       // $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ");

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


        return view('site.client.profile', [
            'client' => $client,
            'telephone2' => $telephone2,
            'provinces' => $provinces,
            'districts' => $districts,

            'categories' => $categories,
            'subcategories' => $subcategories,
            //'services' => $services,
            'requests' => $requests,
            'productsSession' => $productsSession,
            'contacts' => $contacts,
        ]);
    }

    public function updateClient(Request $request)
    {
        if(!$client = $this->repository->find(Auth::guard('client')->id()))
        {
            return redirect()->back();
        }

        if($client->eliminado == 'yes')
        {
            return redirect()->back();
        }

        if($request->password != NULL)
        {
            if ($request->new_password == NULL || $request->confirm_password == NULL)
            {
                return redirect()->back()->withInput()->withErrors(['Por favor preencha os dois campos de senha']);
            }

            $credentials = [
                'email' => $client->email,
                'password' => $request->password,
                'eliminado' => 'no',
            ];

            if (Auth::guard('client')->attempt($credentials))
            {
                if($request->new_password != $request->confirm_password)
                {
                    return redirect()->back()->withInput()->withErrors(['As palavras passes são diferentes']);
                }

                $data = $request->all();

                $data['password'] = Hash::make($data['new_password']);

                $client->update($data);

                ClientContact::where('client_id', $client->id)->update([
                    'client_id' => $client->id,
                    'telephone' => $request->telephone2,
                ]);

                return redirect()->back();
            }
            else
            {
                return redirect()->back()->withInput()->withErrors(['A palavra passe actual não confere']);
            }
        }

        else
        {
            Client::where('id', $client->id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "telephone" => $request->telephone,
                "province" => $request->province,
                "district" => $request->district,
                "neighborhood" => $request->neighborhood,
                "street" => $request->street,
                "house_number" => $request->house_number,
            ]);

            ClientContact::where('client_id', $client->id)->update([
                'telephone' => $request->telephone2,
            ]);

            return redirect()->back();
        }

    }
}
