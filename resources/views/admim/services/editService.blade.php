
@extends('admim.master.layout')

@section('title', 'Gestão de Serviços')
@section('pageHeader', 'Gestão de Serviços')


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
                        <h3 class="box-title">Actualizar Serviços</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form action="{{route('admim.services.update', $service->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do Serviço" value="{{$service->name}}">
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
                                            <textarea name="description"  class="textarea" placeholder="Descrição do Serviço"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$service->description}}</textarea>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço</label>
                                <input name="price" type="number" class="form-control" id="exampleInputPassword1" placeholder="Preço do Serviço" value="{{$service->price}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Desconto</label>
                                <input name="discount" type="number" class="form-control" id="exampleInputPassword1" placeholder="Desconto do Serviço, caso haja algum" value="{{$service->discount}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Imagem do Serviço</label>
                                <input name="image" type="file" id="exampleInputFile">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">{{$service->status}}</option>
                                    <option>@if("{$service->status}" == "Offline") Online @endif @if("{$service->status}" == "Online")Offline @endif</option>
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
