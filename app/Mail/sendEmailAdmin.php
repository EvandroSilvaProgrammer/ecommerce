<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\RequestProduct;

class sendEmailAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $idRequest)
    {
        $this->admin = $admin;
        $this->idRequest = $idRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // Efectuar consulta que contenha a referência do pedido, e os Produtos do mesmo pedido.

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

        //dd($requestProducts);

        $this->subject('Efectivação de Encomenda');
        $this->to($this->admin->email, $this->admin->name);
        $this->cc('jose.subtil@doriema.com', 'Jose Subtil');

        return $this->markdown('site.email.emailAdmin', [
            'requests' => $requests,
            'requestProducts' => $requestProducts
        ]);
    }
}
