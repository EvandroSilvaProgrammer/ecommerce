<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Request as Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;
use App\Models\RequestProduct;
use App\Models\Exchange;
use App\Models\Client;
use App\Models\ProvinceModel;
use App\Models\DisrictModel;
use App\Models\RequestAddress;
use App\Models\ProductColorModel;
use App\Models\Color;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterClientRequest;


class ShopCartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:client');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('VerifyCsrfToken');

        $requests = Pedido::where([
            'status' => 'RE',
            'client_id' => Auth::guard('client')->id()
        ])->get();

        $exchange = Exchange::find(1);

        // DEFAULT PRO MENU
        $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ASC ");

        $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ORDER BY product_subcategorie_tb.name ASC ");

       // $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $productsSession = [];
        if (Auth::guard('client')->check() === false)
        {
            $productsSession = session("cart");
        }
        //----

        // dd([
        //     $requests,
        //     $requests[0]->RequestProduct,
        //     $requests[0]->RequestProduct[0]->product
        // ]);

        return view('site.shopcart.cart', [
            'categories' => $categories,
            'subcategories' => $subcategories,
           // 'services' => $services,

            'requests' => $requests,
            'exchange' => $exchange,
            'contacts' => $contacts,

            'productsSession' => $productsSession,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();

        $productID = $req->input('id');
        $color = $req->input('color');
        $qtd = $req->input('qtd');

        if($qtd <= 0)
        {
            $req->session()->flash('mensagem-falha', "Lamentamos, mas $qtd não é uma quantidade válida!");
            return back();
        }

        $product = ProductModel::find($productID);

        if($product->qtd == 0)
        {
            $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente este livro está esgotado! ");
            return back();
        }

        if($qtd > $product->qtd)
        {
            $req->session()->flash('mensagem-falha', "Lamentamos, mas o nosso estoque é insuficiente para $qtd unidades, deste livro! ");
            return back();
        }

        if($color != 'Default')
        {
            $colorP = Color::where('color', $color)->first();
            $productColor = ProductColorModel::where('color', $colorP->id)->where('product', $product->id)->first();

            if($qtd > $productColor->qtd)
            {
                $req->session()->flash('mensagem-falha', "Lamentamos, mas não pode adicionar $qtd unidade(s) ao carrinho, deste livro com a cor $color. ");
                return back();
            }
        }

        if(empty($product->id))
        {
            $req->session()->flash('mensagem-falha', 'Lamentamos, mas este livro não foi encontrado na nossa loja!');
            return redirect()->route('shopCart.index');
        }

        // GUARDAR COM SESSÃO
        if (Auth::guard('client')->check() === false)
        {
            if (session()->has('cart'))
            {
                $carrinho = Session::get("cart");

                $i = 0;
                foreach($carrinho as $item)
                {
                    if ($item['id'] == $productID)
                    {
                        $novositens = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'image' => $item['image'],
                            "new_price" => $item['new_price'],
                            "qtd" => $item['qtd'] + 1,
                        ];

                        $carrinho[$i] = $novositens;
                        session()->put('cart', $carrinho);

                        return back();
                    }
                    $i++;
                }
            }

            $cartProduct = [];
            $cartProduct['id'] = $productID;
            $cartProduct['name'] = $product->name;
            $cartProduct['image'] = $product->image;
            $cartProduct['new_price'] = $product->new_price;
            $cartProduct['qtd'] = $qtd;

            $req->session()->push("cart", array_merge((array)Session::get("cart",[]), $cartProduct));

            return back();
        }
        // FIM GUARDAR COM SESSÃO

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

        $verification = RequestProduct::where('request_id', $requestID)->where('product_id', '=', $productID)->where('color', '=', $color)->where('status', '=', 'RE')->get();

        if( $verification->count() != 0 )
        {
            foreach($verification as $vf)
            { $vf->qtd; }

            if($vf->qtd+$qtd > $product->qtd)
            {
                $req->session()->flash('mensagem-falha', "Lamentamos, mas não pode adicionar mais $qtd unidade(s) ao carrinho, deste livro, pois nosso estoque é insuficiente para esta quantidade. ");
                return back();
            }

            if($color != 'Default')
            {
                if($vf->qtd+$qtd > $productColor->qtd)
                {
                    $req->session()->flash('mensagem-falha', "Lamentamos, mas não pode adicionar mais $qtd unidade(s) ao carrinho, deste livro com a cor $color. ");
                    return back();
                }
            }

            // DB::select("UPDATE request_product SET qtd = $vf->qtd+{$qtd} WHERE request_id = {$requestID}
            // AND product_id = {$productID} AND color = '$color' AND status = 'RE' ");

            //ACTUALIZAR NO SERVIDOR
            RequestProduct::where([
                'request_id' => $requestID,
                'product_id' => $productID,
                'color' => $color
            ])->update(['qtd' => $vf->qtd+$qtd]);

            return back();
        }

        else
        {
            RequestProduct::create([
                'request_id' => $requestID,
                'product_id' => $productID,
                'value' => $product->new_price,
                'status' => 'RE',
                'qtd' => $qtd,
                'color' => $color,
                'time' => date('H:i:s'),

            ]);

            return back();
        }
    }

    public function purchases()
    {
        $clientID = Auth::guard('client')->id();

        $purchases = Pedido::where([
            'status' => 'EC',
            'client_id' => $clientID,
        ])->orderBy('id', 'DESC')->paginate(2);

        foreach($purchases as $purchase)
        {
            $date1 = strtotime( $purchase->updated_at );
            $date2 = strtotime(date('Y/m/d H:i'));

            $intervalo = abs( $date2 - $date1 ) / 60;

            // Tempo em minutos
            if($intervalo >= 5760)
            {
                Pedido::where('id', '=', $purchase->id)->update(['status' => 'CA', 'canceled_for' => 'TIME']);

                $productsQtdIncrease = RequestProduct::where([
                    'request_id' => $purchase->id,
                    'status' => 'EC',
                ])->get();

                foreach($productsQtdIncrease as $productQtdIncrease)
                {
                    $product = ProductModel::find($productQtdIncrease->product_id);

                    ProductModel::where('id', $product->id)->update(['qtd' => $product->qtd + $productQtdIncrease->qtd]);
                }

                RequestProduct::where([
                    'request_id' => $purchase->id,
                    'status' => 'EC',
                ])->update(['status' => 'CA']);
            }
        }

        $canceled = Pedido::where([ 'status' => 'PA', 'client_id' =>  $clientID])
                            ->orWhere(function($query) {
                                         $clientID = Auth::guard('client')->id();
                                         $query->where('client_id', $clientID)
                                               ->where('status', 'EN');})
                            ->orderBy('updated_at', 'DESC')->paginate(2);


       // DEFAULT PRO MENU
       $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
       WHERE product_tb.subcategorie = product_subcategorie_tb.id
       AND product_subcategorie_tb.categorie = product_categorie_tb.id
       AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no' ORDER BY product_categorie_tb.description ASC ");

       $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
       WHERE product_tb.subcategorie = product_subcategorie_tb.id
       AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ORDER BY product_subcategorie_tb.name ASC ");

       // $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ORDER BY id DESC ");

        $requests = Pedido::where([
            'status' => 'RE',
            'client_id' => Auth::guard('client')->id()
        ])->get();

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

       //----

       return view('site.shopcart.purchases', [
           'categories' => $categories,
           'subcategories' => $subcategories,
           //'services' => $services,

           'purchases' => $purchases,
           'canceled' => $canceled,
           'requests' => $requests,
           'contacts' => $contacts,
       ]);
    }

    /*
    |    Acrescentar uma unidade a um determinado livro que está no carrinho
    */
    public function upQtd($productid, $colorProduct, $statusProduct)
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();

        $productID = $productid;
        $color = $colorProduct;
        $status = $statusProduct;

        $product = ProductModel::find($productID);

        if(empty($product->id))
        {
            $req->session()->flash('mensagem-falha', 'Lamentamos, mas este livro não foi encontrado na nossa loja!');
            return redirect()->route('shopCart.index');
        }

        // ACTUALIZAR COM SESSÃO
        if (Auth::guard('client')->check() === false)
        {
            if (session()->has('cart'))
            {
                $carrinho = Session::get("cart");

                $i = 0;
                foreach($carrinho as $item)
                {
                    if ($item['id'] == $productID)
                    {
                        if($item['qtd'] + 1 > $product->qtd)
                        {
                            $qtd = $item['qtd'] + 1;

                            $req->session()->flash('mensagem-falha', "Lamentamos, mas o nosso estoque é insuficiente para $qtd unidades, deste livro! ");
                            return back();
                        }

                        $novositens = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'image' => $item['image'],
                            "new_price" => $item['new_price'],
                            "qtd" => $item['qtd'] + 1,
                        ];

                        $carrinho[$i] = $novositens;
                        session()->put('cart', $carrinho);

                        return back();
                    }
                    $i++;
                }
            }
        }
        // FIM acTUALIZAR COM SESSÃO

        $clientID = Auth::guard('client')->id();

        $requestID = Pedido::queryID([
            'client_id' => $clientID,
            'status' => 'RE',
        ]);

        $requestProduct = RequestProduct::where('request_id', '=', $requestID)->where('product_id', '=', $productID)
                                          ->where('color', '=', $color)->where('status', '=', 'RE')->first();

        if($product->qtd == 0)
        {
            RequestProduct::where('request_id', '=', $requestID)->where('product_id', '=', $productID)->where('status', '=', 'RE')->delete();

            $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente este livro esgotou!
            Sentimos muito mas ele foi deletado do seu carrinho. Pode entrar em contacto connosco para fazer um pedido especial. ");
            return back();
        }

        if($color != 'Default')
        {
            $colorP = Color::where('color', $color)->first();
            $productColor = ProductColorModel::where('color', $colorP->id)->where('product', $product->id)->first();

            // Apaga livro no pedido cuja a quantidade da cor esteja zerada
            if($productColor->qtd == 0)
            {
                $requestProduct->delete();
                $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente ficamos sem stock para este livro com a cor $color!
                                        Sentimos muito mas ele foi deletado do seu carrinho. ");
                return back();
            }

            if($requestProduct->qtd+1 > $productColor->qtd)
            {
                $req->session()->flash('mensagem-falha', "Lamentamos, mas não pode adicionar mais uma unidade ao carrinho, deste livro com a cor $color! ");
                return back();
            }
        }

        if($color == 'Default')
        {
            if($requestProduct->qtd+1 > $product->qtd)
            {
                $qtd = $requestProduct->qtd+1;
                $req->session()->flash('mensagem-falha', "Lamentamos, mas o nosso estoque é insuficiente para $qtd unidades, deste livro! ");
                return back();
            }
        }

        // DB::select("UPDATE request_product SET qtd = $requestProduct->qtd+1 WHERE request_id = {$requestID}
        // AND product_id = {$productID} AND color = '$color' AND status = 'RE' ");

        //ACTUALIZAR NO SERVIDOR
        RequestProduct::where([
            'request_id' => $requestID,
            'product_id' => $productID,
            'color' => $color,
            'status' => 'RE'
        ])->update(['qtd' => $requestProduct->qtd+1]);

        return back();
    }

    public function downQtd($productid, $colorProduct, $statusProduct)
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();

        $productID = $productid;
        $color = $colorProduct;
        $status = $statusProduct;

        $product = ProductModel::find($productID);

        if(empty($product->id))
        {
            $req->session()->flash('mensagem-falha', 'Lamentamos, mas este livro não foi encontrado na nossa loja!');
            return back();
        }

        // ACTUALIZAR COM SESSÃO
        if (Auth::guard('client')->check() === false)
        {
            if (session()->has('cart'))
            {
                $carrinho = Session::get("cart");

                $i = 0;
                foreach($carrinho as $item)
                {
                    if ($item['id'] == $productID)
                    {
                        if($item['qtd'] - 1 <= 0)
                        {
                            $qtd = $item['qtd'] - 1;

                            $req->session()->flash('mensagem-falha', "Lamentamos, mas $qtd não é uma quantidade válida!");
                            return back();
                        }

                        $novositens = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'image' => $item['image'],
                            "new_price" => $item['new_price'],
                            "qtd" => $item['qtd'] - 1,
                        ];

                        $carrinho[$i] = $novositens;
                        session()->put('cart', $carrinho);

                        return back();
                    }
                    $i++;
                }
            }
        }
        // FIM ACTUALIZAR COM SESSÃO


        $clientID = Auth::guard('client')->id();

        $requestID = Pedido::queryID([
            'client_id' => $clientID,
            'status' => 'RE',
        ]);

        if($product->qtd == 0)
        {
            RequestProduct::where('request_id', '=', $requestID)->where('product_id', '=', $productID)->where('status', '=', 'RE')->delete();

            $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente este livro esgotou!
            Sentimos muito mas ele foi deletado do seu carrinho. Pode entrar em contacto connosco para fazer um pedido especial. ");
            return back();
        }

        $requestProduct = RequestProduct::where('request_id', '=', $requestID)->where('product_id', '=', $productID)
                                          ->where('color', '=', $color)->where('status', '=', 'RE')->first();

        if($requestProduct->qtd-1 == 0)
        {
            $qtd = $requestProduct->qtd-1;

            $req->session()->flash('mensagem-falha', "Lamentamos, mas $qtd não é uma quantidade válida!");
            return back();
        }

        if($color != 'Default')
        {
            $colorP = Color::where('color', $color)->first();
            $productColor = ProductColorModel::where('color', $colorP->id)->where('product', $product->id)->first();

            // Apaga livro no pedido cuja a quantidade da cor esteja zerada
            if($productColor->qtd == 0)
            {
                $requestProduct->delete();

                $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente ficamos sem stock para este livro com a cor $color!
                                        Sentimos muito mas ele foi deletado do seu carrinho. ");
                return back();
            }
        }

        // DB::select("UPDATE request_product SET qtd = $requestProduct->qtd-1 WHERE request_id = {$requestID}
        // AND product_id = {$productID} AND color = '$color' AND status = 'RE' ");

        //ACTUALIZAR NO SERVIDOR
        RequestProduct::where([
            'request_id' => $requestID,
            'product_id' => $productID,
            'color' => $color,
            'status' => 'RE'
        ])->update(['qtd' => $requestProduct->qtd-1]);


        return back();
    }

    public function updateQtd()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();

        $productID = $req->input('id');
        $color = $req->input('color');
        $qtd = $req->input('qtd');

        if($qtd <= 0)
        {
            $req->session()->flash('mensagem-falha', "Lamentamos, mas $qtd não é uma quantidade válida! ");
            return back();
        }

        $product = ProductModel::find($productID);

        if(empty($product->id))
        {
            $req->session()->flash('mensagem-falha', 'livro não encontrado na nossa loja!');
            return redirect()->route('shopCart.index');
        }

        // ACTUALIZAR COM SESSÃO
        if (Auth::guard('client')->check() === false)
        {
            if (session()->has('cart'))
            {
                $carrinho = Session::get("cart");

                $i = 0;
                foreach($carrinho as $item)
                {
                    if ($item['id'] == $productID)
                    {
                        if($qtd > $product->qtd)
                        {
                            $req->session()->flash('mensagem-falha', "Lamentamos, mas o nosso estoque é insuficiente para $qtd unidades, deste livro! ");

                            return back();
                        }

                        $novositens = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'image' => $item['image'],
                            "new_price" => $item['new_price'],
                            "qtd" => $qtd,
                        ];

                        $carrinho[$i] = $novositens;
                        session()->put('cart', $carrinho);

                        return back();
                    }
                    $i++;
                }
            }
        }
        // FIM acTUALIZAR COM SESSÃO

        $clientID = Auth::guard('client')->id();

        $requestID = Pedido::queryID([
            'client_id' => $clientID,
            'status' => 'RE',
        ]);


        if($product->qtd == 0)
        {
            RequestProduct::where('request_id', '=', $requestID)->where('product_id', '=', $productID)->where('status', '=', 'RE')->delete();

            $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente este livro esgotou!
            Sentimos muito mas ele foi deletado do seu carrinho. Pode entrar em contacto connosco para fazer um pedido especial. ");
            return back();
        }

        $requestProduct = RequestProduct::where('request_id', '=', $requestID)->where('product_id', '=', $productID)
                                          ->where('color', '=', $color)->where('status', '=', 'RE')->first();

        if($color != 'Default')
        {
            $colorP = Color::where('color', $color)->first();
            $productColor = ProductColorModel::where('color', $colorP->id)->where('product', $product->id)->first();

            // Apaga livro no pedido cuja a quantidade da cor esteja zerada
            if($productColor->qtd == 0)
            {
                $requestProduct->delete();

                $req->session()->flash('mensagem-falha', "Lamentamos, mas infelizmente ficamos sem stock para este livro com a cor $color!
                                        Sentimos muito mas ele foi deletado do seu carrinho. ");
                return back();
            }

            if($qtd > $productColor->qtd)
            {
                $req->session()->flash('mensagem-falha', "Lamentamos, mas não pode adicionar $qtd unidade(s) ao carrinho, deste livro com a cor $color! ");
                return back();
            }
        }

        if($color == 'Default')
        {
            if($qtd > $product->qtd)
            {
                $req->session()->flash('mensagem-falha', "Lamentamos, mas o nosso estoque é insuficiente para $qtd unidades, deste livro! ");
                return back();
            }
        }

        // DB::select("UPDATE request_product SET qtd = $qtd WHERE request_id = {$requestID}
        // AND product_id = {$productID} AND color = '$color' AND status = 'RE' ");

        //ACTUALIZAR NO SERVIDOR
        RequestProduct::where([
            'request_id' => $requestID,
            'product_id' => $productID,
            'color' => $color,
            'status' => 'RE'
        ])->update(['qtd' => $qtd]);

        return back();
    }

    public function cancel()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $requestID = $req->input('request_id');
        $requestProductID = $req->input('id');
        $clientID = Auth::guard('client')->id();

        if( empty($requestProductID) )
        {
            $req->session()->flash('mensagem-falha', 'Nenhum item selecionado para cancelamento');
            return redirect()->route('shopCart.purchases');
        }

        $checkRequest = Pedido::where([
            'id' => $requestID,
            'client_id' => $clientID,
            'status' => 'EC',
        ])->exists();

        if( !$checkRequest )
        {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado para cancelamento');
            return redirect()->route('shopCart.purchases');
        }

        $checkProducts = RequestProduct::where([
            'request_id' => $requestID,
            'status' => 'EC',
        ])->whereIn('id', $requestProductID)->exists();

        if( !$checkProducts )
        {
            $req->session()->flash('mensagem-falha', 'Livros do pedido não encontrados');
            return redirect()->route('shopCart.purchases');
        }

        RequestProduct::where([
            'request_id' => $requestID,
            'status' => 'EC',
        ])->whereIn('id', $requestProductID)->update(['status' => 'CA']);

        $checkRequestCancel = RequestProduct::where([
            'request_id' => $requestID,
            'status' => 'EC',
        ])->exists();

        if (!$checkRequestCancel)
        {
            Pedido::where(['id' => $requestID])->update(['status' => 'CA', 'canceled_for' => 'CLIENT']);

            $req->session()->flash('mensagem-sucesso', 'Compra cancelada com sucesso!');
        }
        else
        {
            $req->session()->flash('mensagem-sucesso', 'Item(s) da compra cancelado(s) com sucesso!');
        }

        $productsQtdIncrease = RequestProduct::where([
            'request_id' => $requestID,
            'status' => 'CA',
        ])->whereIn('id', $requestProductID)->get();

        $total_request_product_canceled = 0;

        foreach($productsQtdIncrease as $productQtdIncrease)
        {
            $product = ProductModel::find($productQtdIncrease->product_id);

            ProductModel::where('id', $product->id)->update(['qtd' => $product->qtd + $productQtdIncrease->qtd]);

            $total_request_product_canceled+= $productQtdIncrease->total_of_request_product;
        }

        //dd($total_request_product_canceled);

        Pedido::where(['id' => $requestID])->update(['total_of_request' => $req->total_pedido - $total_request_product_canceled]);

        $purchases = Pedido::where([
            'status' => 'EC',
            'client_id' => $clientID,
        ])->orderBy('created_at', 'DESC')->get();
        foreach($purchases as $purchase)
        {
            $date1 = strtotime( $purchase->updated_at );
            $date2 = strtotime(date('Y/m/d H:i'));

            $intervalo = abs( $date2 - $date1 ) / 60;

            if($intervalo >= 1440)
            {
                Pedido::where('id', '=', $purchase->id)->update(['status' => 'CA', 'canceled_for' => 'TIME']);

                RequestProduct::where([
                    'request_id' => $purchase->id,
                    'status' => 'EC',
                ])->update(['status' => 'CA']);
            }
        }

        return redirect()->route('shopCart.purchases');
    }

    public function checkout(Request $request)
    {
        if(Auth::guard('client')->check() === false)
        {
            if(isset($request->register))
            {
                if($request->name === NULL)
                {
                    $request->session()->flash('nameError', "O nome do cliente é obrigatório");
                    return redirect()->back()->withInput();
                }

                elseif($request->email === NULL)
                {
                    $request->session()->flash('emailError', "O email do cliente é obrigatório");
                    return redirect()->back()->withInput();
                }

                $emailsClients = Client::select('email')->get();

                foreach ($emailsClients as $emailClient)
                {

                   if ( $emailClient->email === $request->email )
                   {
                        $request->session()->flash('emailError2', "O email digitado já está em uso no nosso sistema! Tente outro");
                        return redirect()->back()->withInput();
                   }
                }

                if($request->password === NULL)
                {
                    $request->session()->flash('passwordError', "A senha é obrigatória.");
                    return redirect()->back()->withInput();
                }

                if($request->password != $request->confirm_password)
                {
                    $request->session()->flash('passwordsError', "As senhas diferem!");
                    return redirect()->back()->withInput();
                }

                Client::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (Auth::guard('client')->attempt($credentials))
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

                foreach(Session::get("cart") as $key => $item  )
                {
                    $verification = RequestProduct::where('request_id', $requestID)->where('product_id', '=', $item['id'])->where('status', '=', 'RE')->get();

                    if( $verification->count() != 0 )
                    {
                        foreach($verification as $vf)
                        { $vf->qtd; }

                        // DB::select("UPDATE request_product SET qtd = $vf->qtd+{$item['qtd']} WHERE request_id = {$requestID}
                        // AND product_id = {$item['id']} AND status = 'RE' ");

                        //ACTUALIZAR NO SERVIDOR
                        RequestProduct::where([
                            'request_id' => $requestID,
                            'product_id' => $item['id'],
                            'status' => 'RE'
                        ])->update([ 'qtd' => $vf->qtd+$item['qtd'] ]);
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
                return redirect()->route('shopCart.checkout');

               //return redirect()->route('products.showHome');
            }

            $request->session()->flash('checkoutError', 'Desculpa mas os dados não conferem! Tente novamente');
            return redirect()->back()->withInput();
        }

        $clientAddress = Client::find(Auth::guard('client')->id());
        if($clientAddress->province == null || $clientAddress->district == null || $clientAddress->street == null || $clientAddress->neighborhood == null || $clientAddress->telephone == null)
        {
            return redirect()->route('client.showRegister');
        }

        $province = ProvinceModel::find($clientAddress->province);
        $district = DisrictModel::find($clientAddress->district);

        $provinces = DB::select("SELECT * FROM province_tb");
        $districts = DB::select("SELECT * FROM district_tb");

        //---
        $categories = DB::select(" SELECT DISTINCT product_categorie_tb.* FROM product_categorie_tb, product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_subcategorie_tb.categorie = product_categorie_tb.id
        AND product_tb.status = 'online' AND product_categorie_tb.eliminado = 'no'  ");

        $subcategories = DB::select(" SELECT DISTINCT product_subcategorie_tb.* FROM product_subcategorie_tb, product_tb
        WHERE product_tb.subcategorie = product_subcategorie_tb.id
        AND product_tb.status = 'online' AND product_subcategorie_tb.eliminado = 'no' ");

       // $services = DB::select(" SELECT * FROM service_tb WHERE status = 'online' ");

        $requests = Pedido::where([
            'status' => 'RE',
            'client_id' => Auth::guard('client')->id()
        ])->get();
        //----

        $coordenadas = DB::select(" SELECT * FROM  coord_bancarias");

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");


        return view('site.shopcart.checkout', [
            //'services' => $services,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'requests' => $requests,
            'contacts' => $contacts,
            'coordenadas' => $coordenadas,

            'clientAddress' => $clientAddress,
            'province' => $province,
            'district' => $district,

            'provinces' => $provinces,
            'districts' => $districts,
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

    //FINALIZA PEDIDO
    public function toEnd()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $requestID = $req->input('request_id');
        $clientID = Auth::guard('client')->id();

        if($req->payment_method === null)
        {
            $req->session()->flash('mensagem-falha', 'Desculpa mas a compra não pode ser concluída até informar uma forma de pagamento!');
            return back();
        }

        // Verificar se tem endereço diferente
        if( ($req->address_different === 'on') )
        {
            if( $req->district != null && $req->street != null && $req->neighborhood != null )
            {
                RequestAddress::create([
                    'request_id' => $req->request_id,
                    'province' => $req->province,
                    'district' => $req->district,
                    'street' => $req->street,
                    'neighborhood' => $req->neighborhood,
                    'house_number' => $req->house_number,
                ]);
            }

            else
            {
                $req->session()->flash('mensagem-falha', 'Marcou a opção de entrega em endereço diferente mas não preencheu todos os campos necessários! Por favor verifique.');
                return redirect()->back()->withInput();
            }
        }

        if($req->note != null)
        {
            Pedido::where('id', '=', $req->request_id)->update(['note' => $req->note]);
        }

        $checkRequest = Pedido::where([
            'id' => $requestID,
            'client_id' => $clientID,
            'status' => 'RE',
        ])->exists();

        if( !$checkRequest )
        {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado');
            return redirect()->route('shopCart.purchases');
        }

        $checkProduct = RequestProduct::where([
            'request_id' => $requestID
        ])->exists();

        if( !$checkProduct )
        {
            $req->session()->flash('mensagem-falha', 'Livros do pedido não encontrados!');
            return redirect()->route('shopCart.purchases');
        }

        $requestProducts = RequestProduct::where('request_id', $requestID)->get();

        $products = ProductModel::all();

        foreach($requestProducts as $requestProduct)
        {
            foreach($products as $product)
            {
                if($requestProduct->product_id == $product->id)
                {
                    if($product->qtd == 0 || $product->qtd < $requestProduct->qtd)
                    {
                        RequestProduct::where('product_id', $requestProduct->product_id)->where('request_id', $requestProduct->request_id)
                        ->delete();
                    }

                    ProductModel::where('id', $requestProduct->product_id)->update(['qtd' => $product->qtd - $requestProduct->qtd]);

                    RequestProduct::where('product_id', $requestProduct->product_id)->where('request_id', $requestProduct->request_id)
                    ->update(['total_of_request_product' => $product->new_price * $requestProduct->qtd]);
                }
            }
        }

        RequestProduct::where([
            'request_id' => $requestID
        ])->update([
            'status' => 'EC',
            'created_at' => date('Y/m/d'),
            'time' => date('H:i:s')
        ]);

        Pedido::where([
            'id' => $requestID
        ])->update([
            'status' => 'EC',
            'payment_method' => $req->payment_method,
            'total_of_request' => $req->total_of_request,
            'created_at' => date('Y/m/d'),
            'time' => date('H:i:s')
        ]);

        $req->session()->flash('mensagem-sucesso', 'Encomenda efectuada com sucesso!');

       return redirect()->route('sendEmail.Compra', $requestID);

        // return redirect()->route('shopCart.purchases');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();

        $requestID = $req->input('request_id');
        $productID = $req->input('product_id');
        $remove_apenas_item = (boolean)$req->input('item');
        $color = $req->input('color');
        $status = $req->input('status');
        $clientID = Auth::guard('client')->id();

        $requestID = Pedido::queryID([
            'id' => $requestID,
            'client_id' => $clientID,
            'status' => 'RE',
        ]);


        if( empty($requestID) )
        {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado');
            return redirect()->route('shopCart.index');
        }

        $where_product = [
            'request_id' => $requestID,
            'product_id' => $productID,
            'color' => $color,
            'status' => $status,
        ];

        $product = RequestProduct::where($where_product)->orderBy('id', 'DESC')->first();

        if( empty($product->id) )
        {
            $req->session()->flash('mensagem-falha', 'livro não encontrado no carrinho');
            return redirect()->route('shopCart.index');
        }

        if( $remove_apenas_item )
        {
            $where_product['id'] = $product->id;
        }

        RequestProduct::where($where_product)->delete();

        $checkRequest = RequestProduct::where([
            'request_id' => $product->request_id
        ])->exists();


        if( !$checkRequest )
        {
            Pedido::where([
                'id' => $product->request_id
            ])->delete();
        }

        return redirect()->route('shopCart.index');
    }

    public function sessionDestroy(Request $request, $chave)
    {
        $carts = Session::get("cart");

        unset($carts[$chave]);
        session()->forget('cart');
        session()->put('cart', $carts);
        session()->save();
        unset($carts[$chave]);

        $collection = collect($carts);

        if($collection->count() == 0)
        {
            session()->forget('cart');
        }

        return redirect()->back();
    }
}
