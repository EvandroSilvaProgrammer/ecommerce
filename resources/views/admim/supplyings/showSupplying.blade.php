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


@section('title', 'Gestão de Fornecedores')
@section('pageHeader', "{$supplying->name}")

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
                <!-- Product main img -->
                <div class="col-md-8">
                    <div>
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Lista de Fornecimento</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Data</th>
                                            <th>Anexo da factura</th>
                                            <th width="5">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($supplyProducts as $supplyProduct)
                                        @if ("{$supplyProduct->eliminado}" == 'no')


                                        <tr>
                                            <td>
                                                {{$supplyProduct->id}}
                                            </td>
                                            <td>{{$supplyProduct->date}}</td>

                                            @can('Visualizar Factura')
                                            <td>
                                                <a href="{{url("storage/{$supplyProduct->pdf}")}}" target="_blank">
                                                    Factura do dia {{$supplyProduct->date}}
                                                </a>
                                            </td>
                                            @else
                                                <td>
                                                    Não tem permissão para visualizar facturas
                                                </td>
                                            @endcan
                                            @can('Apagar Fornecimento')
                                                <td>
                                                    <a href="{{route('admim.supply.destroy', $supplyProduct->id)}}" class="fa fa-fw fa-trash-o"></a>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="fa fa-fw fa-trash-o"></i>
                                                </td>
                                            @endcan
                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Data</th>
                                            <th>Anexo da factura</th>
                                            <th width="5">Eliminar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!-- /Product main img -->


                <!-- Product details -->
                <div class="col-md-4">
                    <div class="product-details">
                        <h2 class="product-name">INFORMÇÕES GERAIS</h2>

                        <ul class="product-links">
                            @foreach ($provinces as $province)
                            @if ($province->id == $supplying->province)
                            <li>Província:</li>
                            <li>{{$province->name}}</li> <br>
                            @endif
                            @endforeach

                            @foreach ($districts as $district)
                            @if ($district->id == $supplying->district)
                            <li>Município:</li>
                            <li>{{$district->name}}</li> <br>
                            @endif
                            @endforeach

                            <li>Bairro:</li>
                            <li>{{$supplying->neighborhood}}</li> <br>

                            <li>Rua:</li>
                            <li>{{$supplying->street}}</li> <br>

                            <li>Casa nº:</li>
                            <li>{{$supplying->house_number}}</li> <br> <br>


                            <li>Telefones:</li> <br>
                            @foreach ($supplyingTelephones as $supplyingTelephone)
                            <li>
                                @can('Apagar Telefone do Fornecedor')
                                    <a id="trashColor" href="{{route('admim.supplyingTelephone.destroy', $supplyingTelephone->id)}}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                @endcan
                                {{$supplyingTelephone->telephone}}
                            </li> <br>
                            @endforeach

                            <br><li>Emails:</li> <br>
                            @foreach ($supplyingEmails as $supplyingEmail)
                            <li>
                                @can('Apagar Email do Fornecedor')
                                    <a id="trashColor" href="{{route('admim.supplyingEmail.destroy', $supplyingEmail->id)}}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                @endcan
                                <a href="http://{{$supplyingEmail->email}}" target="_blank">{{$supplyingEmail->email}}</a>
                            </li> <br>
                            @endforeach

                        </ul> <br>

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
                        @include('admim.supplyings.includes.modalNewSupply')
                    </div>
                </div>
                <!-- /Product details -->


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</section>
<!-- /.content -->
@endsection
