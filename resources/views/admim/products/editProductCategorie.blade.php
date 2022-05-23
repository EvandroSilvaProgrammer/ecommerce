
@extends('admim.master.layout')

@section('title', 'Gestão de Categorias dos Livros')
@section('pageHeader', 'Gestão de Categorias dos Livros')


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
                        <h3 class="box-title">Actualizar Categoria dos Livros</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form action="{{route('admim.productCategories.update', $categorie->id)}}" method="POST" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome da categoria" value="{{$categorie->description}}">
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
