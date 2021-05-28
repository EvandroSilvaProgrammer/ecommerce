@extends('admim.master.layout')

@section('title', 'Gestão de Campanha')
@section('pageHeader', 'Gestão de Campanha')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @can('Cadastrar Produtos')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar campanha</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.promotion.update')}}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label>Produto 1</label>
                                <select name="product_01" class="form-control select2" style="width: 100%;">
                                    <option value=" {{$product01->id}} ">{{$product01->name}}</option>
                                    @foreach ($products as $product)
                                        @if($product01->id != $product->id)
                                            <option value=" {{$product->id}} ">{{$product->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Produto 2</label>
                                <select name="product_02" class="form-control select2" style="width: 100%;">
                                    <option value=" {{$product02->id}} ">{{$product02->name}}</option>
                                    @foreach ($products as $product)
                                        @if($product02->id != $product->id)
                                                <option value=" {{$product->id}} ">{{$product->name}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Numero de dias</label>
                                <input name="number_days" type="number" class="form-control" id="exampleInputPassword1" placeholder="Tempo de duração da campanha" value="{{$promotion->number_days}}">
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-default collapsed-box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Descrição</h3>
                                            <!-- tools box -->
                                            <div class="pull-right box-tools">
                                                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                title="Expandir">
                                                <i class="fa fa-plus"></i></button>
                                            </div>
                                            <!-- /. tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body pad">
                                            <textarea name="description"  class="textarea" placeholder="Descrição do produto"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$promotion->description}}</textarea>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">{{$promotion->status}}</option>
                                    @if($promotion->status == 'Offline')
                                        <option>Online</option>
                                    @endif
                                    @if($promotion->status == 'Online')
                                        <option>Offline</option>
                                    @endif
                                </select>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Actualizar</button>

                            <a href="{{route('admim.promotion.edit.cancel')}}" style="margin-left:10%">
                                <button type="button" class="btn btn-danger" >Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    @endcan
</section>
<!-- /.content -->
@endsection
