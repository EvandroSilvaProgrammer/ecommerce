@extends('admim.master.layout')

@section('title', 'Gestão de Serviços')
@section('pageHeader', 'Gestão de Serviços')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    @can('Cadastrar Serviços')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Serviços</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.services.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do produto" value="{{old('name')}}">
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
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço</label>
                                <input name="price" type="number" class="form-control" id="exampleInputPassword1" placeholder="Preço do produto" value="{{old('price')}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Desconto</label>
                                <input name="discount" type="number" class="form-control" id="exampleInputPassword1" placeholder="Desconto do produto, caso haja algum" value="{{old('price')}}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Imagem do produto</label>
                                <input name="image" type="file" id="exampleInputFile">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Offline</option>
                                    <option>Online</option>
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
    @endcan

    @can('Visualizar Serviços')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Serviços</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Desconto</th>
                        <th>Status</th>
                        <th width="10">Editar</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($services as $service)
                    @if ("{$service->eliminado}" == "no")

                        <tr>
                            <td>{{$service->id}}</td>

                            <td>
                                <a href="{{route('admim.services.show', $service->id)}}">
                                    {{$service->name}}
                                </a>
                            </td>
                            <td> {{number_format($service->price, 2, ',', ' ')}} </td>
                            <td>{{$service->discount}}</td>
                            <td>{{$service->status}}</td>
                            <td>
                                @can('Editar Serviços')
                                    <a href="{{route('admim.services.edit', $service->id)}}" class="fa fa-fw fa-edit"></a>
                                @else
                                    <i class="fa fa-fw fa-edit"></i>
                                @endcan
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Desconto</th>
                        <th>Status</th>
                        <th width="10">Editar</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @endcan


</section>
<!-- /.content -->
@endsection
