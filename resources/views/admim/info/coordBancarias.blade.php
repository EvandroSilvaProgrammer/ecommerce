@extends('admim.master.layout')

@section('title', 'Doriema Online - Coordenadas Bancárias')
@section('pageHeader', 'Coordenadas Bancárias')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @can('Coordenadas Bancárias')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coordenadas Bancárias</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.coordenadas.store')}}" method="POST" enctype="multipart/form-data" role="form">
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
    @endcan


    @can('Visualizar Produtos')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Coordenadas Bancárias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Banco</th>
                        <th>IBAN</th>
                        <th width="10">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coords as $coord)
                    <tr>
                        <td>{{$coord->id}}</td>
                        <td>{{$coord->banc}}</td>
                        <td>{{$coord->iban}}</td>
                        @can('Editar Coordenadas Bancarias')
                        <td>
                            <a href="{{route('admim.coordenadas.edit', $coord->id)}}" class="fa fa-fw fa-edit"></a>
                        </td>
                        @else
                        <td>
                            <i class="fa fa-fw fa-edit"></i>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @endcan


</section>
<!-- /.content -->
@endsection
