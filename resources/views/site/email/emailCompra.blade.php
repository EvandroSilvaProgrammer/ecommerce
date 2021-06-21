<!DOCTYPE html>
<html lang="pt-pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>

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
                                    <h3 style="padding-top: 10px; color:#28a745; text-align: center;"> Encomenda efectuada com sucesso! </h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 0px 20px 10px;">
                                    @foreach ($requests as $request)
                                        Cliente: <b>{{$request->clientname}}</b> <br>
                                        Referência pedido: <b>{{$request->id}}</b> <br>
                                        Status: <b style="color: red;"> Aguardando pagamento </b>
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
                                    <br>
                                    Encontre abaixo as nossas coordenadas bancárias: <br><br>
                                    @foreach ($coordenadas as $coordenada)
                                        {{$coordenada->banc}} - {{$coordenada->iban}}<br><br>
                                    @endforeach
                                    <br>
                                    <p >Lorem ipsum, dolor sit amet consectetur adipisicing elit. Similique, ipsa cum officia consequatur expedita enim molestias recusandae facere sed aut alias error vero nihil aliquid ut. Provident ad aspernatur temporibus.</p> <br>

                                    <p style="text-align: center"> Processado por computador. Este documento não serve de factura </p>
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
    </body>
</html>
