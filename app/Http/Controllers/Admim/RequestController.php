<?php

namespace App\Http\Controllers\Admim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Request as Pedido;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\RequestProduct;
use Illuminate\Support\Facades\DB;
use App\Models\ProvinceModel;
use App\Models\DisrictModel;
use App\Models\ProductModel;
use App\Models\RequestAddress;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        $requests = Pedido::where('status', '=', 'EC')->get();
        $clients = Client::all();

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

        return view('admim.requests.news', [
            'requests' => $requests,
            'clients' => $clients,
        ]);
    }

    public function canceled()
    {
        $requests = Pedido::where('status', '=', 'CA')->get();
        $clients = Client::all();

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

        return view('admim.requests.canceled', [
            'requests' => $requests,
            'clients' => $clients,
        ]);
    }

    public function pay()
    {
        $requests = Pedido::where('status', '=', 'PA')->get();
        $clients = Client::all();

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

        return view('admim.requests.pay', [
            'requests' => $requests,
            'clients' => $clients,
        ]);
    }

    public function delivery()
    {
        $requests = Pedido::where('status', '=', 'EN')->get();
        $clients = Client::all();

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

        return view('admim.requests.delivery', [
            'requests' => $requests,
            'clients' => $clients,
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
        $purchases = Pedido::where([
            'id' => $id,
        ])->orderBy('created_at', 'DESC')->get();

        if($purchases == [])
        {
            return redirect()->back();
        }

        foreach($purchases as $purchase){$purchase->client_id;}

        $requestAddress = RequestAddress::where('request_id', '=', $id)->first();

        $client = Client::find($purchase->client_id);
        $clientContacts = ClientContact::where('client_id', '=', $purchase->client_id)->get();

        if($requestAddress != null)
        {
            $diferentAddress = 1;
            $province = ProvinceModel::find($requestAddress->province);
            $district = DisrictModel::find($requestAddress->district);
        }
        elseif ($requestAddress == null) {
            $diferentAddress = 0;
            $province = ProvinceModel::find($client->province);
            $district = DisrictModel::find($client->district);
        }

        return view('admim.requests.showRequest', [
            'purchases' => $purchases,
            'client' => $client,
            'clientContacts' => $clientContacts,
            'province' => $province,
            'district' => $district,

            'diferentAddress' => $diferentAddress,
            'requestAddress' => $requestAddress,
        ]);
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

        Pedido::where([
            'id' => $id
        ])->update([
            'status' => 'PA',
        ]);

        RequestProduct::where([
            'request_id' => $id,
            'status' => 'EC',
        ])->update(['status' => 'PA']);

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

        return redirect()->route('sendEmail.Confirm', $id);
    }

    public function confirmDelivery($id)
    {
        Pedido::where([
            'id' => $id
        ])->update([
            'status' => 'EN',
        ]);

        RequestProduct::where([
            'request_id' => $id,
            'status' => 'PA',
        ])->update(['status' => 'EN']);

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

        return redirect()->route('sendEmail.Final', $id);


    }

    public function reports()
    {
        $totalGeneralRequests = Pedido::count();

        $orderedRequests = Pedido::where('status', 'EC')->count();

        $deliveryRequests = Pedido::where('status', 'EN')->count();

        $canceledRequests = Pedido::where('status', 'CA')->count();


        return view('admim.requests.reports', [
            'totalGeneralRequests' => $totalGeneralRequests,
            'orderedRequests' => $orderedRequests,
            'deliveryRequests' => $deliveryRequests,
            'canceledRequests' => $canceledRequests,
        ]);
    }

}
