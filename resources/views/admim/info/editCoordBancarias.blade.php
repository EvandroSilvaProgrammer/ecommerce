
@extends('admim.master.layout')

@section('title', 'Gestão de Produtos')
@section('pageHeader', "Actualizar Produtos")


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
                        <h3 class="box-title">Actualizar {{$coordenada->banc}}</h3>
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

                    <form action="{{route('admim.coordenadas.update', $coordenada->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Banco</label>
                                <input name="banc" type="text" class="form-control" id="exampleInputEmail1" placeholder="Banco" value="{{old('banc')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">IBAN</label>
                                <input name="iban" type="text" class="form-control" id="exampleInputPassword1" placeholder="IBAN" value="{{old('iban')}}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Adicionar</button>
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
