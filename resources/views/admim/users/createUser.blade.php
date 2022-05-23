@extends('admim.master.layout')

@section('title', 'Gestão de Usuários')
@section('pageHeader', 'Gestão de Usuários')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    @can('Cadastrar Usuarios')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Usuários</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.users.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do usuário" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email do usuário" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Palavra-Passe</label>
                                <input name="password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Palavra-Passe do usuário" value="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirme Palavra-Passe</label>
                                <input name="comfirm_password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Confirme Palavra-Passe do usuário" value="">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @endcan

    @can('Visualizar Usuarios')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Usuários</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th width="50">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            <a href="{{route('admim.users.show', $user->id)}}">
                                {{$user->name}}
                            </a>
                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            @can('Editar Usuarios')
                            <a href="{{route('admim.users.edit', $user->id)}}">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>
                            @else
                            <i class="fa fa-fw fa-edit"></i>
                            @endcan
                        </td>
                    </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th width="50">Editar</th>
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
