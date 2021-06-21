<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\AllRequestsExport;
use App\Exports\OrderedRequestsExport;
use App\Exports\DeliveryRequestsExport;
use App\Exports\CanceledRequestsExport;
use App\Exports\PersonalizedRequestsExport;
use App\Exports\RequestProductsExport;

use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Request as Pedido;
use App\Models\Client;
use Illuminate\Support\Facades\Session;

class FacturaController extends Controller
{
    public function clientPF($request_id, $total_request)
    {
        $request = Pedido::find($request_id);

        $client = Client::find($request->client_id);

        $requestProducts = DB::select(" SELECT product_tb.name, request_product.status, request_product.value,
        request_product.qtd, request_product.created_at, request_product.time, request_product.updated_at
        FROM product_tb, request_product
        WHERE product_tb.id = request_product.product_id AND request_product.request_id = {$request_id} ");

        $coordenadas = DB::select(" SELECT * FROM coord_bancarias ");

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $PDF = PDF::loadview('site.facturaProForma.fPF', [
            "request" => $request,
            "client" => $client,
            "total_request" => $total_request,
            'coordenadas' => $coordenadas,
            'contacts' => $contacts,

            "requestProducts" => $requestProducts,
        ]);

        //$PDF->save(storage_path ("Pró-forma refer.:{$request_id}.pdf ") );

        return $PDF->setPaper('a4')->stream("Trutaa - Factura Pró-forma refer.:{$request_id}.pdf");
    }

    public function visitantePF($total_request)
    {
        $requestProducts = Session::get("cart");

        $coordenadas = DB::select(" SELECT * FROM coord_bancarias ");

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $PDF = PDF::loadview('site.facturaProForma.fPF_Visitante', [
            "total_request" => $total_request,
            'coordenadas' => $coordenadas,
            'contacts' => $contacts,
            "requestProducts" => $requestProducts,
        ]);

        return $PDF->setPaper('a4')->stream("Trutaa - Factura Pró-forma.pdf");
    }
}
