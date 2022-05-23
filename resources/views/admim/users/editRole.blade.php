@extends('admim.master.layout')

@section('title', 'Gestão de Funções')
@section('pageHeader', 'Gestão de Funções')


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
                        <h3 class="box-title">Actualizar as informações da função {{$role->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.roles.update', $role->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome da função" value="{{$role->name}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descrição</label>
                                <input name="label" type="text" class="form-control" id="exampleInputEmail1" placeholder="Descrição da função" value="{{$role->label}}">
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
