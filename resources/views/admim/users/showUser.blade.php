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


@section('title', 'Gestão de Usuários')
@section('pageHeader', "{$user->name}")

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
                                <h3 class="box-title">Lista de funções no sistema</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Função</th>
                                            <th>Descrição</th>
                                            <th width="5">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{$role->role}}</td>
                                                <td>{{$role->label}}</td>
                                                <td>
                                                    @can('Cadastrar Funções')
                                                        <a href="{{route('admim.rolesUsers.destroy', $role->id)}}" class="fa fa-fw fa-trash-o"></a>
                                                    @else
                                                        <i class="fa fa-fw fa-trash-o"></i>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Função</th>
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
                        <h2 class="product-name">INFORMAÇÕES GERAIS</h2>

                        <ul class="product-links">
                            <li>Nome:</li>
                            <li>{{$user->name}}</li> <br>

                            <li>Email:</li>
                            <li>{{$user->email}}</li> <br>

                        </ul> <br>


                        @can('Cadastrar Funções')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-roles" class="add-to-cart-btn"><i class="fa fa-fw fa-truck"></i>Adicionar Função</button>
                            </div>
                        @endcan

                        @can('Editar Usuarios')
                            <div class="add-to-cart">
                                <a href="{{route('admim.users.edit', $user->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Editar Usuário</button>
                                </a>
                            </div>
                        @endcan

                        @can('Apagar Usuarios')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-danger-user" class="add-to-cart-btn"><i class="fa fa-trash-o"></i>Remover Usuário</button>
                            </div>
                        @endcan


                        @include('admim.users.includes.modalConfirmRemoval')
                        @include('admim.users.includes.modalAddRoles')

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
