


<table align="center" border="1" cellpadding="0" cellspacing="0" width="600">
    <tr>
        <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
            <img src="{{asset('site/img/logo.png')}}" alt="Logo Trutaa" width="200" height="100" style="display: block;" />
        </td>
    </tr>
    <tr>
        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td>
                        <h3> Encomenda Finalizada! </h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0 30px 0;">
                        <p>Olá {{ $client->name }},</p>
                        @foreach ($purchases as $request)
                            <p>A entrega do seu pedido com a referência <b>{{ $request->id }}</b> foi feita com sucesso!<br><br>
                                O Trutaa agradece pela sua preferência!</p>
                        @endforeach

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
