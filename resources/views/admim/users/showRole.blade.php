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


@section('title', 'Gestão de Funções')
@section('pageHeader', "{$role->name}")

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
                                <h3 class="box-title">Lista de permissões</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Permissão</th>
                                            <th>Descrição</th>
                                            <th width="5">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{$permission->name}}</td>
                                                <td>{{$permission->label}}</td>
                                                <td>
                                                    @can('Apagar Permissões')
                                                        <a href="{{route('admim.permissionRole.destroy', $permission->id)}}" class="fa fa-fw fa-trash-o"></a>
                                                    @else
                                                        <i class="fa fa-fw fa-trash-o"></i>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Permissão</th>
                                            <th>Descrição</th>
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
                            <li>Nome:</li>
                            <li>{{$role->name}}</li> <br>

                            <li>Descrição:</li>
                            <li>{{$role->label}}</li> <br>

                        </ul> <br>

                        @can('Adicionar Permissões')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-permissions" class="add-to-cart-btn"><i class="fa fa-fw fa-truck"></i>Adicionar Permissões</button>
                            </div>
                        @endcan

                        @can('Editar Funções')
                            <div class="add-to-cart">
                                <a href="{{route('admim.roles.edit', $role->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Editar Função</button>
                                </a>
                            </div>
                        @endcan

                        @can('Apagar Funções')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-danger-role" class="add-to-cart-btn"><i class="fa fa-trash-o"></i>Remover Função</button>
                            </div>
                        @endcan

                        @include('admim.users.includes.modalConfirmRemovalRole')

                        @include('admim.users.includes.modalAddPermissions')

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
