@extends('admim.master.layout')

@section('title', 'Gestão de Campanha')
@section('pageHeader', 'Gestão de Campanha')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @if(!isset($promotion))
    @can('Cadastrar Produtos')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Criar campanha</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.promotion.store')}}" method="POST" role="form" enctype="multipart/form-data" >
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputFile">Imagem da campanha</label>
                                <input name="image" type="file" id="exampleInputFile">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Publicar</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @endcan
    @endif

</section>
<!-- /.content -->
@endsection
