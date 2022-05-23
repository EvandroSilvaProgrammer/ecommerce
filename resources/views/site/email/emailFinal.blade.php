<table align="center" border="1" cellpadding="0" cellspacing="0" width="600">
    <tr>
        <td align="center" bgcolor="#ffffff" style="padding: 20px 0 20px 10px;">
            <img src="{{asset('site/img/logo.png')}}" alt="Logo Trutaa" width="200" height="100" style="display: block;" /> <br> <br>

            <h2>Trutaa</h2>
            @foreach ($contacts as $contact)
                <h3> Endereço: {{$contact->adress}}  </h3>
                <h3> Email: {{$contact->email}} </h3>
                <h3> Tel.: {{$contact->phone_number}} </h3>
            @endforeach
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td>
                        <h3 style="padding-top: 10px; color:#28a745; text-align: center;"> Entrega efetuada com sucesso! </h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0px 20px 10px;">
                        @foreach ($requests as $request)
                            Cliente: <b>{{$request->clientname}}</b> <br>
                            Referência pedido: <b>{{$request->id}}</b> <br>
                            Status: <b style="color: #28a745;"> Entregue </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="1" cellpadding="0" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Livro
                                    </th>
                                    <th>
                                        Qtd
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestProducts as $requestProduct)
                                <tr>
                                    <td style="text-align: center">
                                        {{$requestProduct->id}}
                                    </td>
                                    <td style="text-align: center">
                                        {{$requestProduct->name}}
                                    </td>
                                    <td style="text-align: center">
                                        {{$requestProduct->qtd}}
                                    </td>
                                    <td style="text-align: center">
                                        {{ number_format($requestProduct->total_of_request_product, 2, ',', ' ')}} Akz
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        <tr>
                            <td colspan="2" style="padding: 10px 0px 10px 10px"><strong>Total:</strong> {{ number_format($request->total_of_request, 2, ',', ' ')}} Akz </td>
                            @endforeach
                        </tr>

                    </td>
                </tr>
                <tr>
                    <td style="padding: 0 0px 0 10px">
                        <p> A sua encomenda foi entregue com sucesso! <br> Seu/s livro/s  foram entregues em seu respectivo endereço descrito no processo de compra, estamos abertos a qualquer dúvida ou sugestão de vossa parte. <br> Atenciosamente, <br> Trutaa Lda. Operações.</p> <br>

                        <p style="text-align: center"> <b>OBS.:</b> Processado por computador. Este documento deve ser conservado porque representa prova de compra , pagamento  e recepção desta respectiva encomenda  na loja online Trutaa Livraria. </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#2B2D42" style="padding: 30px 30px 30px 30px;">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="75%" style="text-align: center">
                        &copy; 2021 Todos os direitos reservados | <a href="#" style="font-size: 14px; color: #ccc">Trutaa</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
