@extends('admim.master.layout')

@section('title', 'Gestão de Usuários')
@section('pageHeader', 'Gestão de Usuários')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Actualizar dados do usuário {{$user->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.users.update', $user->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <input type="hidden" name="id" value="{{$user->id}}">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do usuário" value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email do usuário" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Palavra-Passe</label>
                                <input name="password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Palavra-Passe do usuário" value="{{$user->password}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirme Palavra-Passe</label>
                                <input name="comfirm_password" type="password" class="form-control" id="exampleInputEmail1" placeholder="Confirme Palavra-Passe do usuário" value="{{$user->password}}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</section>
<!-- /.content -->
@endsection
