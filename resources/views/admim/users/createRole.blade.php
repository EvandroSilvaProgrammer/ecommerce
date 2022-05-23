@extends('admim.master.layout')

@section('title', 'Gestão de Funções')
@section('pageHeader', 'Gestão de Funções')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    @can('Cadastrar Funções')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar nova função</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.roles.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome da função" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descrição</label>
                                <input name="label" type="text" class="form-control" id="exampleInputEmail1" placeholder="Descrição da função" value="{{old('label')}}">
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

    @can('Visualizar Funções')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Funções</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="50">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>
                            @if ("{$role->name}" == 'Administrador')
                                {{$role->name}}
                            @else
                                <a href="{{route('admim.roles.show', $role->id)}}">
                                    {{$role->name}}
                                </a>
                            @endif
                        </td>
                        <td>{{$role->label}}</td>
                        <td>
                            @if ("{$role->name}" == 'Administrador')
                                <i class="fa fa-fw fa-edit"></i>
                            @else
                                 @can('Editar Funções')
                                    <a href="{{route('admim.roles.edit', $role->id)}}">
                                        <i class="fa fa-fw fa-edit"></i>
                                    </a>
                                @else
                                    <i class="fa fa-fw fa-edit"></i>
                                @endcan
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
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
