
@extends('admim.master.layout')

@section('title', 'Gestão de Subcategorias')
@section('pageHeader', 'Gestão de Subcategorias')


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
                        <h3 class="box-title">Cadastrar Subcategorias</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.productSubCategories.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome da Subcategoria" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="categorie" class="form-control select2" style="width: 100%;">
                                    @foreach ($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->description}}</option>
                                    @endforeach
                                </select>
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

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Subcategorias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th width="50">Editar</th>
                        <th width="50">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategorie)
                    <tr>
                        <td>{{$subcategorie->id}}</td>
                        <td>
                            <a href="{{route('admim.productSubCategories.show', $subcategorie->id)}}"> {{$subcategorie->name}} </a>
                        </td>

                        @foreach ($categories as $categorie)
                            @if ($subcategorie->categorie  == $categorie->id)
                                <td>{{$categorie->description}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="{{route('admim.productSubCategories.edit', $subcategorie->id)}}" class="fa fa-fw fa-edit"></a>
                        </td>
                        <td><a href="{{route('admim.productSubCategories.destroy', $subcategorie->id)}}" class="fa fa-trash-o"></a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th width="50">Editar</th>
                        <th width="50">Eliminar</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection
