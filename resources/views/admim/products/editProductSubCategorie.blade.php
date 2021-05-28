
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
                        <h3 class="box-title">Actualizar Subcategoria</h3>
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

                    <form action="{{route('admim.productSubCategories.update', $subcategorie->id)}}" method="POST" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Subcategoria" value="{{$subcategorie->name}}">
                            </div>
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="categorie" class="form-control select2" style="width: 100%;">
                                    @foreach ($categories as $categorie)
                                        @if ($categorie->id === $subcategorie->categorie)
                                            <option selected value="{{$categorie->id}}">{{$categorie->description}}</option>
                                        @else
                                            <option value="{{$categorie->id}}">{{$categorie->description}}</option>
                                        @endif
                                    @endforeach
                                </select>
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
