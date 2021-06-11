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
            <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
                <img src="{{asset('site/img/logo.png')}}" alt="Logo Doriema" width="200" height="100" style="display: block;" />
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                <table border="1" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <h3> NOVA ENCOMENDA </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0 30px 0;">
                            @foreach ($requests as $request)
                                Tem uma nova encondemenda com a referência: <b>{{$request->id}}</b> <br>
                                Cliente: <b>{{$request->clientname}}</b> <br>
                                Email: <b> {{$request->email}} </b> <br>
                                Telefone: <b> {{$request->telephone}} </b> <br>
                            @endforeach
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
                                        <td>
                                            {{$requestProduct->id}}
                                        </td>
                                        <td>
                                            {{$requestProduct->name}}
                                        </td>
                                        <td>
                                            {{$requestProduct->qtd}}
                                        </td>
                                        <td>
                                            {{ number_format($requestProduct->total_of_request_product, 2, ',', ' ')}} Akz
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#2B2D42" style="padding: 30px 30px 30px 30px;">
                <table border="1" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="75%">
                            &copy; <script>document.write(new Date().getFullYear());</script> Todos os direitos reservados | <a href="#" style="font-size: 14px; color: #ccc">Trutaa</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </table>



</body>
</html>
