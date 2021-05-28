<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\ClientContact;
use App\Models\Request as Pedido;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idReq)
    {
        // $this->client = $client;
        $this->idReq = $idReq;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $purchases = Pedido::where([
            'id' => $this->idReq,
        ])->orderBy('created_at', 'DESC')->get();

        if($purchases == [])
        {
            return redirect()->back();
        }

        foreach($purchases as $purchase){$purchase->client_id;}
        $client = Client::find($purchase->client_id);
        $clientContacts = ClientContact::where('client_id', '=', $purchase->client_id)->get();


        $this->subject('Confirmação de Pagamento');
        $this->to($client->email, $client->name);



        return $this->markdown('site.email.emailConfirm', [
            'client' => $client,
            'purchases' => $purchases
        ]);
    }
}
