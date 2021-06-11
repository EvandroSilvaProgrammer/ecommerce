<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Factura Pró-Forma </title>
    </head>

</head>

<style>
    .invoice {
        position: relative;
        background: #fff;
        border: 1px solid #f4f4f4;
        padding: 20px;
        margin: 10px 25px;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-xs-12 {
        width: 100%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .page-header {
        margin: 10px 0 20px 0;
        font-size: 22px;
        padding-bottom: 9px;
        border-bottom: 1px solid #eee;
        font-family: 'Source Sans Pro',sans-serif;
        font-weight: 500;
        line-height: 1.1;
        color: inherit;
        display: block;
        margin-block-start: 0.83em;
        margin-block-end: 0.83em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    .page-header>small {
        color: #666;
        display: block;
        margin-top: 5px;
        font-size: 65%;
        font-weight: 400;
        line-height: 1;
    }

    .pull-right {
        float: right!important;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .row::before
    {
        display: table;
        content: " ";
    }

    .row:after {
        clear: both;
        display: table;
        content: " ";
    }

    body {
        font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 1.42857143;
    }

    .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
        display: table;
        border-color: grey;
    }

    .table>thead:first-child>tr:first-child>th {
        border-top: 0;
    }

    .table>thead>tr>th {
        border-bottom: 2px solid #f4f4f4;
    }

    .table>thead>tr>th {
        vertical-align: bottom;
    }

    .table>thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
    }

    th {
        text-align: left;
    }

    th {
        display: table-cell;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    tbody {
        display: table-row-group;
        vertical-align: middle;
        border-color: inherit;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    tr {
        display: table-row;
        vertical-align: inherit;
        border-color: inherit;
    }

    .table>tbody>tr>td
    {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 2px solid #ddd;
    }

    .page-header
    {
        font-weight: bold;
    }

    .col-sm-4 {
        position: relative;
        min-height: 1px;
        width: 30%;
        float: left;
        padding-left: 13px;

        .lead
        {
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 300;
            line-height: 1.4;
        }

        .table-responsive {
            min-height: .01%;
            overflow-x: auto;
        }

    }

</style>

<?php
$path = 'site/img/logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

<body>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> <i class="fa fa-globe"></i> <img src="{{ $base64 }}" alt="Logo" class="logo" style="width: 200px; height:100px;"/>
                    <small class="pull-right">{{date('d/M/Y H:i:s')}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>

        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <strong style="font-weight: bold">Trutaa.</strong><br>
                    @foreach ($contacts as $contact)
                    Endereço: {{$contact->adress}} <br>
                    Email: {{$contact->email}} <br>
                    Tel.: {{$contact->phone_number}}
                    @endforeach
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Cliente:
                <address>
                    <strong>Cliente não identificado</strong>
                </address>
            </div>
            <!-- /.col -->
            {{-- <div class="col-sm-4 invoice-col">
                <b>Pedido Refer.: {{$request->id}} </b><br> <br>

                @if ($request->status == 'EC')
                <b>Status: Encomendado </b><br> <br>
                @endif

                @if ($request->status == 'PA')
                <b>Status: Pago </b><br> <br>
                @endif

                @if ($request->status == 'EN')
                <b>Status: Entregue </b><br><br>
                @endif

                @if ($request->status == 'CA')
                <b>Status: Cancelado </b><br> <br>
                @endif
            </div> --}}
            <!-- /.col -->
        </div> <br> <br>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Livro</th>
                            <th>Qtd</th>
                            <th>Preço</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total_pedido = 0; @endphp
                        @foreach (Session::get("cart") as $item => $product )
                        <tr>
                            <td> {{$product['name']}} </td>
                            <td> {{$product['qtd']}} </td>
                            <td> {{number_format($product['new_price'], 2, ',', '.')}} </td>
                            @php $total = $product['new_price'] * $product['qtd'] @endphp
                            <td> {{number_format($total, 2, ',', '.')}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <!-- /.col -->
            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:60%"></th>
                            <td><strong>Total: {{number_format($total_request, 2, ',', '.')}} AKZ</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-xs-6">
                    <p class="lead">Coordenadas bancárias:</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        @foreach ($coordenadas as $coordenada)

                        <strong>{{$coordenada->banc}}</strong> - {{$coordenada->iban}} <br>

                        @endforeach
                    </p>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->

        <footer>
            <p style="text-align: center">
                PREÇOS COM IVA INCLUIDO À TAXA DE 14%, ENCOMENDE NA LOJA ONLINE E RECEBA
                COMODAMENTE EM QUALQUER LUGAR.
            </p>
        </footer>

    </body>
    </html>
