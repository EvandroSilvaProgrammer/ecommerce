<?php

namespace App\Mail;

use App\Models\CoordBancarias;
use App\Models\RequestProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendEmailCompra extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $idRequest)
    {
        $this->user = $user;
        $this->idRequest = $idRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Efectuar a consulta para a referência do pedido do cliente em questão, valor total do pedido, etc...
        $requests = DB::select("

            SELECT request.*, client.name as clientname,
            client.email, client.telephone

            FROM request, client

            WHERE client.id = request.client_id
            AND request.id = '$this->idRequest'

            GROUP BY request.id, request.client_id, request.status, request.note, request.payment_method, request.total_of_request, request.canceled_for,
            request.created_at, request.time, request.updated_at, client.name, client.email, client.telephone

        ");

        $requestProducts = RequestProduct::where('request_id', $this->idRequest)
                                        ->join('product_tb', 'product_tb.id', '=', 'request_product.product_id')
                                        ->select('product_tb.name', 'product_tb.id', 'request_product.qtd', 'request_product.total_of_request_product')
                                        ->get();


        $coordenadas = DB::select(" SELECT * FROM coord_bancarias ");

        //dd($requestProducts);

        $this->subject('Nova Encomenda - Doriema Online');
        $this->to($this->user->email, $this->user->name);

        return $this->markdown('site.email.emailCompra', [
            'requests' => $requests,
            'requestProducts' => $requestProducts,
            'coordenadas' => $coordenadas
        ]);
    }
}
