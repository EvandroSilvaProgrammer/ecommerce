@extends('admim.master.layout')

@section('title', 'Doriema Online - Sobre Nós')
@section('pageHeader', 'Sobre Nós')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @can('Sobre Nos')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sobre Nós</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.sobrenos.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Informações sobre Doriema</label>
                                <textarea name="description"  class="textarea" placeholder="Descrição sobre a Doriema"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('description')}}</textarea>
                            </div>
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
            <h3 class="box-title">Sobre a Doriema</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div  style="width: 80%; margin-left: 10% ">
                @foreach ($about as $sobre)
                    {{ $sobre->description }}
                @endforeach
            </div>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @endcan



</section>
<!-- /.content -->
@endsection
