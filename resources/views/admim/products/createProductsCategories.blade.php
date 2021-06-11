
@extends('admim.master.layout')

@section('title', 'Gestão de Categorias dos Livros')
@section('pageHeader', 'Gestão de Categorias dos Livros')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    @can('Cadastrar Categoria dos Produtos')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Categoria dos Livros</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.productCategories.store')}}" method="POST" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome da categoria" value="{{old('name')}}">
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

    @can('Visualizar Categoria dos Livros')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Categorias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th width="50">Editar</th>
                        <th width="50">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)

                    <tr>
                        <td>{{$categorie->id}}</td>
                        <td>{{$categorie->description}}</td>

                        @can('Editar Categoria dos Produtos')
                        <td>
                            <a href="{{route('admim.productCategories.edit', $categorie->id)}}" class="fa fa-fw fa-edit"></a>
                        </td>
                        @else
                        <td>
                            <i class="fa fa-fw fa-edit"></i>
                        </td>
                        @endcan

                        @can('Apagar Categoria dos Produtos')
                        <td><a href="{{route('admim.productCategories.destroy', $categorie->id)}}" class="fa fa-trash-o"></a></td>
                        @else
                        <td>
                            <i class="fa fa-fw fa-trash-o"></i>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th width="50">Editar</th>
                        <th width="50">Eliminar</th>
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
