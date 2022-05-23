@extends('admim.master.layout')

@section('title', 'Pedidos Entregues')
@section('pageHeader', 'Pedidos Entregues')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @can('Visualizar Pedidos Entregues')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista dos pedidos entregues</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Pedido Refer.:</th>
                        <th>Cliente</th>
                        <th>Forma de pagamento</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                    <tr>
                        <td>
                            <a href="{{route('admim.request.show',$request->id )}}">{{$request->id}} </a>
                        </td>

                        @foreach ($clients as $client)
                            @if ($client->id == $request->client_id)
                                <td>
                                    <a href="{{route('admim.request.show',$request->id )}}"> {{$client->name}} </a>
                                </td>
                            @endif
                        @endforeach

                        <td> {{$request->payment_method}} </td>

                        <td> {{number_format($request->total_of_request, 2, ',', '.') }} </td>

                        <td> {{$request->updated_at->format('d/m/Y H:i')}} </td>

                        @if ($request->status == 'EN')
                            <td> Entregue </td>
                        @endif
                    </tr>
                    @empty

                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Cliente</th>
                        <th>Forma de pagamento</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @endcan

</section>
<!-- /.content -->
@endsection
