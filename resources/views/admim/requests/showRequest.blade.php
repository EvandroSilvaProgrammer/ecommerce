<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="{{asset('site/css/bootstrap.min.css')}}"/>

<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{asset('site/css/slick.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('site/css/slick-theme.css')}}"/>

<!-- nouislider -->
<link type="text/css" rel="stylesheet" href="{{asset('site/css/nouislider.min.css')}}"/>

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="{{asset('site/css/font-awesome.min.css')}}">

<!-- Custom stlylesheet -->

<link type="text/css" rel="stylesheet" href="{{asset('site/css/style.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('site/css/newStyleSkeBug.css')}}"/>


@extends('admim.master.layout')


@section('title', 'Gestão de pedidos')
@section('pageHeader', "Gestão de pedidos")

@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                @forelse($purchases as $request)
                <!-- Product main img -->
                <div class="col-md-8">
                    <div>
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Lista de Produtos para o pedido Refer.: {{$request->id}}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nome</th>
                                            <th>Qtd</th>
                                            <th>Cor</th>
                                            <th>Status</th>
                                            <th>Preço</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total_itens = 0; $total_pedido = 0; @endphp

                                        @foreach ($request->RequestProduct as $RP)
                                            <tr>
                                                @if ($RP->status == 'CA')
                                                    <td style="color: red">{{ $RP->product->id }} </td>
                                                    <td style="color: red">{{ $RP->product->name }}</td>
                                                    <td style="color: red">{{ $RP->qtd }}</td>
                                                    <td style="color: red">{{ $RP->color }}</td>
                                                    <td style="color: red">Cancelado</td>
                                                    <td style="color: red">{{ number_format($RP->product->new_price, 2, ',', '.') }}</td>

                                                    @php
                                                    $total_produto = $RP->product->new_price * $RP->qtd;
                                                    $total_itens+=1;
                                                    @endphp

                                                    <td style="color: red">{{ number_format($total_produto, 2, ',', '.') }}</td>
                                                @else
                                                    <td>{{ $RP->product->id }} </td>
                                                    <td>{{ $RP->product->name }}</td>
                                                    <td>{{ $RP->qtd }}</td>
                                                    <td>{{ $RP->color }}</td>
                                                    @if ($RP->status == 'EC')
                                                        <td>Encomendado</td>
                                                    @endif
                                                    @if ($RP->status == 'PA')
                                                        <td>Pago</td>
                                                    @endif
                                                    @if ($RP->status == 'EN')
                                                        <td>Entregue</td>
                                                    @endif

                                                    <td>{{ number_format($RP->product->new_price, 2, ',', '.') }}</td>
                                                    @php
                                                        $total_produto = $RP->product->new_price * $RP->qtd;
                                                        $total_itens+=1;
                                                        if ($RP->status != 'CA')
                                                        {
                                                            $total_pedido += $total_produto;
                                                        }
                                                    @endphp
                                                    <td>{{ number_format($total_produto, 2, ',', '.') }}</td>
                                                @endif



                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Nome</th>
                                            <th>Qtd</th>
                                            <th>Cor</th>
                                            <th>Status</th>
                                            <th>Preço</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                        @if ($request->note != null)
                        <h3>Nota:</h3>
                        <li>{{$request->note}}</li>
                    @endif
                    </div>
                </div>
                <!-- /Product main img -->


                <!-- Product details -->
                <div class="col-md-4">
                    <div class="product-details">

                        @if ($request->status == 'CA')
                            @if ($request->canceled_for == 'CLIENT')
                                <h2 style="color: red" >Pedido cancelado pelo cliente</h2>
                            @else
                                <h2 style="color: red" >Pedido cancelado por tempo</h2>
                            @endif
                        @else
                            <h2>Valor total do pedido: <br> AKZ {{ number_format($total_pedido, 2, ',', '.') }}</h2>
                        @endif

                        <ul class="product-links">
                            <h3>Cliente:</h3>
                            <li>{{$client->name}}</li>

                            <h3>Endereço da entrega:</h3>

                            <li>Província:</li>
                            <li>{{$province->name}}</li> <br>

                            <li>Município:</li>
                            <li>{{$district->name}}</li> <br>

                            @if ($diferentAddress == 0)
                                <li>Bairro:</li>
                                <li>{{$client->neighborhood}}</li> <br>

                                <li>Rua:</li>
                                <li>{{$client->street}}</li> <br>

                                <li>Casa nº:</li>
                                <li>{{$client->house_number}}</li> <br>
                            @endif

                            @if ($diferentAddress == 1)
                                <li>Bairro:</li>
                                <li>{{$requestAddress->neighborhood}}</li> <br>

                                <li>Rua:</li>
                                <li>{{$requestAddress->street}}</li> <br>

                                <li>Casa nº:</li>
                                <li>{{$requestAddress->house_number}}</li> <br>
                            @endif



                            <h3>Contactos:</h3>

                            <li>Telefone:</li> <br>
                            <li>{{$client->telephone}}</li> <br>
                            @forelse ($clientContacts as $clientContact)
                                <li>{{$clientContact->telephone}}</li> <br> <br>
                            @empty
                                <br>
                            @endforelse

                            <li>Email:</li> <br>
                            <li>{{$client->email}}</li>

                        </ul> <br>

                        @if($request->status == 'EC')
                            <div class="add-to-cart">
                                <a href="{{route('admim.request.update', $request->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Confirmar pagamento</button>
                                </a>
                            </div>
                        @endif

                        @if($request->status == 'PA')
                            <div class="add-to-cart">
                                <a href="{{route('admim.request.confirmDelivery', $request->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Confirmar entrega</button>
                                </a>
                            </div>
                        @endif

                        <form action="{{route('admim.ReportsRequestProducts.requestProducts')}}" method="POST">
                            @csrf
                            <input type="hidden" name="request_id" value="{{$request->id}}">
                            <input type="hidden" name="reportFormat" value="Excel">

                            <div class="add-to-cart">
                                <button type="submit" class="add-to-cart-btn"><i class="fa fa-download"></i>Gerar relatório Excel</button>
                            </div>
                        </form>

                        <form action="{{route('admim.ReportsRequestProducts.requestProducts')}}" method="POST">
                            @csrf

                            <input type="hidden" name="request_id" value="{{$request->id}}">

                            <input type="hidden" name="request_status" value="{{$request->status}}">

                            <input type="hidden" name="reportFormat" value="PDF">

                            <input type="hidden" name="client_name" value="{{$client->name}}">

                            <input type="hidden" name="province" value="{{$province->name}}">

                            <input type="hidden" name="district" value="{{$district->name}}">

                            @if ($diferentAddress == 0)
                                <input type="hidden" name="neighborhood" value="{{$client->neighborhood}}">
                                <input type="hidden" name="street" value="{{$client->street}}">
                                <input type="hidden" name="house_number" value="{{$client->house_number}}">
                            @endif

                            @if ($diferentAddress == 1)
                                <input type="hidden" name="neighborhood" value="{{$requestAddress->neighborhood}}">
                                <input type="hidden" name="street" value="{{$requestAddress->street}}">
                                <input type="hidden" name="house_number" value="{{$requestAddress->house_number}}">
                            @endif

                            <input type="hidden" name="client_telephone" value="{{$client->telephone}}">

                            <input type="hidden" name="client_email" value="{{$client->email}}">

                            <input type="hidden" name="total_request" value="{{$total_pedido}}">

                            <input type="hidden" name="payment_method" value="{{$request->payment_method}}">

                            <div class="add-to-cart">
                                <button type="submit" class="add-to-cart-btn"><i class="fa fa-download"></i>Gerar relatório PDF</button>
                            </div>
                        </form>


                        {{--
                        @can('Cadastrar Fornecimento')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-newSupply" class="add-to-cart-btn"><i class="fa fa-fw fa-truck"></i>Novo Fornecimento</button>
                            </div>
                        @endcan

                        @can('Editar Fornecedores')
                            <div class="add-to-cart">
                                <a href="{{route('admim.supplying.edit', $supplying->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Editar Informações</button>
                                </a>
                            </div>
                        @endcan

                        @can('Cadastrar Telefone do Fornecedor')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-supplyingTelephone" class="add-to-cart-btn"><i class="fa fa-fw fa-phone"></i>Adicionar Telefone</button>
                            </div>
                        @endcan

                        @can('Cadastrar Email do Fornecedor')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-supplyingEmail" class="add-to-cart-btn"><i class="fa fa-fw fa-phone"></i>Adicionar Email</button>
                            </div>
                        @endcan

                        @can('Apagar Fornecedores')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-danger-supplying" class="add-to-cart-btn"><i class="fa fa-trash-o"></i>Remover Fornecedor</button>
                            </div>
                        @endcan

                        @include('admim.supplyings.includes.modalConfirmRemoval')
                        @include('admim.supplyings.includes.modalSupplyingTelephone')
                        @include('admim.supplyings.includes.modalSupplyingEmail')
                        @include('admim.supplyings.includes.modalNewSupply') --}}
                    </div>
                </div>
                <!-- /Product details -->
            @empty
            @endforelse
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</section>
<!-- /.content -->
@endsection
