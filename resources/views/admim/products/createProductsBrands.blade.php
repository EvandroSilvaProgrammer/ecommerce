
@extends('admim.master.layout')

@section('title', 'Gestão de Especialidade')
@section('pageHeader', 'Gestão de Especialidade')


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
                        <h3 class="box-title">Cadastrar Especialidade</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.productBrands.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome da Especialidade" value="{{old('name')}}">
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
            <h3 class="box-title">Lista de Especialidades</h3>
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
                    @foreach ($brands as $brand)
                    <tr>

                        <td> {{$brand->id}} </td>
                        <td> {{$brand->name}} </td>
                        <td>
                            <a href="{{route('admim.productBrands.edit', $brand->id)}}" class="fa fa-fw fa-edit"></a>
                        </td>
                        <td><a href="{{route('admim.productBrands.destroy', $brand->id)}}" class="fa fa-trash-o"></a></td>

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

    {{-- @include('admim.products.includes.modalBrandSubcategorie') --}}
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection
