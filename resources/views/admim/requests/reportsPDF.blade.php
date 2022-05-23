<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Invoice</title>
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
        border-top: 1px solid #f4f4f4;
    }

    .table>tbody>tr>td
    {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

</style>

{{-- Transformar a imagen em um path completo. --}}
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
                    <i class="fa fa-globe"></i> <img src="{{ $base64 }}" alt="Logo" class="logo" style="width: 200px; height:100px;"/>
                    <small class="pull-right">{{date('d/M/Y H:i')}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div style="margin-left: 2%;" class="col-sm-4 invoice-col">
                <address>
                    <strong>Trutaa.</strong><br>
                    @foreach ($contacts as $contact)
                    {{$contact->adress}} <br>
                    {{$contact->email}} <br>
                    {{$contact->phone_number}}

                    @endforeach
                </address>
            </div>
            <!-- /.col -->
            <div style="float: left; text-align: center; margin-top: 2%; margin-bottom: 3%;">
                <address>
                    @if($personalized === true)

                        @php
                            $data1 = explode("-", $date1);
                            $date1 = "{$data1[2]}/{$data1[1]}/{$data1[0]}";

                            $data2 = explode("-", $date2);
                            $date2 = "{$data2[2]}/{$data2[1]}/{$data2[0]}";
                        @endphp

                        @if ($all === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos entre {{$date1}} à {{$date2}} </strong><br>
                        @endif

                        @if ($ordered === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos encomendados entre {{$date1}} à {{$date2}}</strong><br>
                        @endif

                        @if ($delivery === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos entregues entre {{$date1}} à {{$date2}}</strong><br>
                        @endif

                        @if ($canceled === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos cancelados entre {{$date1}} à {{$date2}}</strong><br>
                        @endif
                    @endif

                    @if($personalized === false)
                        @if ($all === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos até {{date('d/M/Y H:i')}}</strong><br>
                        @endif

                        @if ($ordered === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos encomendados até {{date('d/M/Y H:i')}}</strong><br>
                        @endif

                        @if ($delivery === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos entregues até {{date('d/M/Y H:i')}}</strong><br>
                        @endif

                        @if ($canceled === true)
                            <strong style="text-transform: uppercase">Lista de todos os pedidos cancelados até {{date('d/M/Y H:i')}}</strong><br>
                        @endif
                    @endif
                </address>
            </div>
            <!-- /.col -->
            {{-- <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
            </div> --}}
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Pedido Refer</th>
                            <th>Status</th>
                            <th>Forma de pagamento</th>
                            <th>Total do pedido</th>
                            @if ($all === true || $canceled == true)
                            <th>Cancelado por</th>
                            @endif
                            <th>Criado em</th>
                            <th>Actualizado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                        <tr>
                            <td> {{$request->name}} </td>
                            <td> {{$request->email}} </td>
                            <td> {{$request->telephone}} </td>
                            <td> {{$request->id}} </td>
                            <td> {{$request->status}} </td>
                            <td> {{$request->payment_method}} </td>
                            <td> {{$request->total_of_request}} </td>
                            @if ($all === true || $canceled == true)
                            <td> {{$request->canceled_for}} </td>
                            @endif
                            <td> {{$request->created_at}} {{$request->time}} </td>
                            <td> {{$request->updated_at}} </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        {{-- <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>$250.30</td>
                        </tr>
                        <tr>
                            <th>Tax (9.3%)</th>
                            <td>$10.34</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$5.80</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>$265.24</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div> --}}
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        {{-- <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div> --}}
    </section>
    <!-- /.content -->

</body>
</html>
