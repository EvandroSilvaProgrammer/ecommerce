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


@section('title', 'Gestão de Sub-categorias')
@section('pageHeader', "{$subcategorie->name}")

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
                                <h3 class="box-title">Lista de Especialidades associadas a sub-categoria {{$subcategorie->name}} </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Especialidade</th>
                                            <th width="5">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brandsSubcategorie as $bd)
                                            <tr>
                                                <td>{{$bd->id}}</td>
                                                <td>{{$bd->name}}</td>
                                                <td>
                                                    @can('Apagar Permissões')
                                                        <a href="{{route('admim.brandSubcategorie.destroy', $bd->id)}}" class="fa fa-fw fa-trash-o"></a>
                                                    @else
                                                        <i class="fa fa-fw fa-trash-o"></i>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Especialidade</th>
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
                            <li>Nome: {{$subcategorie->name}}</li>
                            <li></li> <br> <br>

                            <li>Categoria:</li>
                            @foreach ($categories as $categorie)
                                @if ($categorie->id == $subcategorie->categorie)
                                    <li>{{$categorie->description}} </li> <br>
                                @endif
                            @endforeach
                        </ul> <br>

                        @can('Adicionar Permissões')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-brand" class="add-to-cart-btn"><i class="fa fa-fw fa-truck"></i>Adicionar Especialidade</button>
                            </div>
                        @endcan

                        @can('Editar Funções')
                            <div class="add-to-cart">
                                <a href="{{route('admim.productSubCategories.edit', $subcategorie->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Editar Sub-categoria</button>
                                </a>
                            </div>
                        @endcan

                        @can('Apagar Funções')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-danger-subCategorie" class="add-to-cart-btn"><i class="fa fa-trash-o"></i>Remover Sub-categoria</button>
                            </div>
                        @endcan

                        @include('admim.products.includes.modalConfirmRemovalSubCategorie')

                        @include('admim.products.includes.modalAddBrand')

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
