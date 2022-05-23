<?php

namespace App\Http\Controllers\Admim;

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


class ReportsRequestsController extends Controller
{
    public function allRequestsExcel()
    {
        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return Excel::download(new AllRequestsExport, "Todos os Pedidos {$day}-{$month}-{$year} {$hour}.xlsx");
    }

    public function allRequestsPDF()
    {
        $requests = DB::select(" SELECT client.name, client.email, client.telephone,
        request.id, request.status, request.payment_method, request.total_of_request,
        request.canceled_for, request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id AND request.status<>'RE' ORDER BY request.updated_at ");

        $requests = collect($requests);

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $PDF = PDF::loadview('admim.requests.reportsPDF', [
            'requests' => $requests,
            'contacts' => $contacts,
            'all' => true,
            'ordered' => false,
            'delivery' => false,
            'canceled' => false,
            'personalized' => false,
        ]);

        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return $PDF->setPaper('a3')->stream("Todos os Pedidos {$day}-{$month}-{$year} {$hour}.pdf");
    }

    public function orderedRequestsExcel()
    {
        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return Excel::download(new OrderedRequestsExport, "Todos os Pedidos Encomendados {$day}-{$month}-{$year} {$hour}.xlsx");
    }

    public function orderedRequestsPDF()
    {
        $requests = DB::select(" SELECT client.name, client.email, client.telephone,
        request.id, request.status, request.payment_method, request.total_of_request,
        request.canceled_for, request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
        AND request.status = 'EC' ORDER BY request.updated_at ");

        $requests = collect($requests);

        $contacts = DB::select(" SELECT * FROM contacts_doriema ");

        $PDF = PDF::loadview('admim.requests.reportsPDF', [
            'requests' => $requests,
            'contacts' => $contacts,
            'all' => false,
            'ordered' => true,
            'delivery' => false,
            'canceled' => false,
            'personalized' => false,
        ]);

        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return $PDF->setPaper('a3')->stream("Todos os Pedidos Encomendados {$day}-{$month}-{$year} {$hour}.pdf");
    }

    public function deliveryRequestsExcel()
    {
        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return Excel::download(new DeliveryRequestsExport, "Todos os Pedidos Entregues {$day}-{$month}-{$year} {$hour}.xlsx");
    }

    public function deliveryRequestsPDF()
    {
        $requests = DB::select(" SELECT client.name, client.email, client.telephone,
        request.id, request.status, request.payment_method, request.total_of_request,
        request.canceled_for, request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
        AND request.status = 'EN' ORDER BY request.updated_at ");

        $requests = collect($requests);

        $PDF = PDF::loadview('admim.requests.reportsPDF', [
            'requests' => $requests,
            'all' => false,
            'ordered' => false,
            'delivery' => true,
            'canceled' => false,
            'personalized' => false,
        ]);

        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return $PDF->setPaper('a3')->stream("Todos os Pedidos Entregues {$day}-{$month}-{$year} {$hour}.pdf");
    }

    public function canceledRequestsExcel()
    {
        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return Excel::download(new CanceledRequestsExport, "Todos os Pedidos Cancelados {$day}-{$month}-{$year} {$hour}.xlsx");
    }

    public function canceledRequestsPDF()
    {
        $requests = DB::select(" SELECT client.name, client.email, client.telephone,
        request.id, request.status, request.payment_method, request.total_of_request,
        request.canceled_for,request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
        AND request.status = 'CA' ORDER BY request.updated_at ");

        $requests = collect($requests);

        $PDF = PDF::loadview('admim.requests.reportsPDF', [
            'requests' => $requests,
            'all' => false,
            'ordered' => false,
            'delivery' => false,
            'canceled' => true,
            'personalized' => false,
        ]);

        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $hour = date('H:i');

        return $PDF->setPaper('a3')->stream("Todos os Pedidos Cancelados {$day}-{$month}-{$year} {$hour}.pdf");
    }

    public function personalizedRequests(Request $request)
    {
        if($request->ReportFormat === 'Excel')
        {
            return (new PersonalizedRequestsExport($request->date1, $request->date2, $request->status))->download("Pedidos {$request->status} entre {$request->date1} à {$request->date2}.xlsx");
        }

        else
        {
            if($request->status === 'all')
            {
                $requests = DB::select(" SELECT client.name, client.email, client.telephone,
                request.id, request.status, request.payment_method, request.total_of_request,
                request.canceled_for, request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
                AND request.created_at BETWEEN '$request->date1' AND '$request->date2' AND request.status<>'RE'
                ORDER BY request.updated_at ");

                $requests = collect($requests);

                $contacts = DB::select(" SELECT * FROM contacts_doriema ");

                $PDF = PDF::loadview('admim.requests.reportsPDF', [
                    'requests' => $requests,
                    'contacts' => $contacts,
                    'all' => true,
                    'ordered' => false,
                    'delivery' => false,
                    'canceled' => false,
                    'personalized' => true,
                    'date1' => $request->date1,
                    'date2' => $request->date2,
                ]);

                return $PDF->setPaper('a3')->stream("Pedidos {$request->status} entre {$request->date1} à {$request->date2}.pdf");
            }

            if($request->status === 'EC')
            {
                $requests = DB::select(" SELECT client.name, client.email, client.telephone,
                request.id, request.status, request.payment_method, request.total_of_request,
                request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
                AND request.status = 'EC'
                AND request.created_at BETWEEN '$request->date1' AND '$request->date2'
                ORDER BY request.updated_at ");

                $requests = collect($requests);

                $contacts = DB::select(" SELECT * FROM contacts_doriema ");

                $PDF = PDF::loadview('admim.requests.reportsPDF', [
                    'requests' => $requests,
                    'contacts' => $contacts,
                    'all' => false,
                    'ordered' => true,
                    'delivery' => false,
                    'canceled' => false,
                    'personalized' => true,
                    'date1' => $request->date1,
                    'date2' => $request->date2,
                ]);

                return $PDF->setPaper('a3')->stream("Pedidos {$request->status} entre {$request->date1} à {$request->date2}.pdf");
            }

            if($request->status === 'EN')
            {
                $requests = DB::select(" SELECT client.name, client.email, client.telephone,
                request.id, request.status, request.payment_method, request.total_of_request,
                request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
                AND request.status = 'EN'
                AND request.created_at BETWEEN '$request->date1' AND '$request->date2'
                ORDER BY request.updated_at ");

                $requests = collect($requests);

                $contacts = DB::select(" SELECT * FROM contacts_doriema ");

                $PDF = PDF::loadview('admim.requests.reportsPDF', [
                    'requests' => $requests,
                    'contacts' => $contacts,
                    'all' => false,
                    'ordered' => false,
                    'delivery' => true,
                    'canceled' => false,
                    'personalized' => true,
                    'date1' => $request->date1,
                    'date2' => $request->date2,
                ]);

                return $PDF->setPaper('a3')->stream("Pedidos {$request->status} entre {$request->date1} à {$request->date2}.pdf");
            }

            if($request->status === 'CA')
            {
                $requests = DB::select(" SELECT client.name, client.email, client.telephone,
                request.id, request.status, request.payment_method, request.total_of_request,
                request.canceled_for, request.created_at, request.time, request.updated_at FROM client, request WHERE client.id = request.client_id
                AND request.status = 'CA'
                AND request.created_at BETWEEN '$request->date1' AND '$request->date2'
                ORDER BY request.updated_at ");

                $requests = collect($requests);

                $contacts = DB::select(" SELECT * FROM contacts_doriema ");

                $PDF = PDF::loadview('admim.requests.reportsPDF', [
                    'requests' => $requests,
                    'contacts' => $contacts,
                    'all' => false,
                    'ordered' => false,
                    'delivery' => false,
                    'canceled' => true,
                    'personalized' => true,
                    'date1' => $request->date1,
                    'date2' => $request->date2,
                ]);

                return $PDF->setPaper('a3')->stream("Pedidos {$request->status} entre {$request->date1} à {$request->date2}.pdf");
            }
        }
    }

    public function requestProducts(Request $request)
    {
        $request_id = $request->request_id;

        if($request->reportFormat === 'Excel')
        {
            return (new RequestProductsExport($request_id))->download("Pedido refer.:{$request->request_id}.xlsx");
        }

        if($request->reportFormat === 'PDF')
        {
            $requestProducts = DB::select(" SELECT product_tb.name, request_product.status, request_product.value,
            request_product.qtd, request_product.created_at, request_product.time, request_product.updated_at
            FROM product_tb, request_product
            WHERE product_tb.id = request_product.product_id AND request_product.request_id = '$request_id' ");

            $contacts = DB::select(" SELECT * FROM contacts_doriema ");


            $PDF = PDF::loadview('admim.requests.reportsRequestProductsPDF', [
                "request_id" => $request->request_id,
                "request_status" => $request->request_status,
                "client_name" => $request->client_name,
                "province" => $request->province,
                "district" => $request->district,
                "neighborhood" => $request->neighborhood,
                "street" => $request->street,
                "house_number" => $request->house_number,
                "client_telephone" => $request->client_telephone,
                "client_email" => $request->client_email,
                "total_request" => $request->total_request,
                "payment_method" => $request->payment_method,

                "requestProducts" => $requestProducts,
                'contacts' => $contacts
            ]);

            return $PDF->setPaper('a4')->stream("Pedido refer.:{$request->request_id}.pdf");
        }
    }

}
