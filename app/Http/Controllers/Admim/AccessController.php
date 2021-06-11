<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Request as Pedido;
use App\Models\RequestProduct;
use App\Models\ProductModel;

class AccessController extends Controller
{
    public function home()
    {
        if(Auth::check() === true)
        {
            $purchases = Pedido::where([
                'status' => 'EC',
            ])->orderBy('created_at', 'DESC')->get();

            foreach($purchases as $purchase)
            {
                $date1 = strtotime( $purchase->updated_at );
                $date2 = strtotime(date('Y/m/d H:i'));

                $intervalo = abs( $date2 - $date1 ) / 60;

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

            return view('admim.home');
        }

        return redirect()->route('admim.showLogin');
    }

    public function showLogin()
    {
        return view('admim.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'eliminado' => 'no'
        ];

        if (Auth::attempt($credentials))
        {
            return redirect()->route('admim');
        }

        return redirect()->back()->withInput()->withErrors(['Os dados não conferem']);
    }

    public function logout()
    {
        Auth::logout();

        $purchases = Pedido::where([
            'status' => 'EC',
        ])->orderBy('created_at', 'DESC')->get();

        foreach($purchases as $purchase)
        {
            $date1 = strtotime( $purchase->updated_at );
            $date2 = strtotime(date('Y/m/d H:i'));

            $intervalo = abs( $date2 - $date1 ) / 60;

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

        return redirect()->route('admim');
    }
}
