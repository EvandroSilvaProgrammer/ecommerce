@extends('admim.master.layout')

@section('title', 'Gestão de Fornecimento')
@section('pageHeader', 'Gestão de Fornecimento')


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
                        <h3 class="box-title">Cadastrar Novo Fornecimento</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.supplyingProduct.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label>Fornecedor</label>
                                <select name="supplying" class="form-control select2" style="width: 100%;">
                                    @foreach ($supplyings as $supplying)
                                        @if ($supplying->eliminado == 'no')
                                        <option value="{{$supplying->id}}">{{$supplying->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Produto</label>
                                <select name="product" class="form-control select2" style="width: 100%;">
                                    @foreach ($products as $product)
                                        @if ($product->eliminado == 'no')
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Quantidade</label>
                                <input name="qtd" type="number" class="form-control" id="exampleInputPassword1" placeholder="Quantidade fornecida" value="{{old('qtd')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço</label>
                                <input name="price" type="number" class="form-control" id="exampleInputPassword1" placeholder="Preço do total fornecido" value="{{old('price')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço em Dolar</label>
                                <input name="dolar" type="number" class="form-control" id="exampleInputPassword1" placeholder="Preço em dolar" value="{{old('dolar')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Data de entrega</label>
                                <input name="date_delivery" type="date" class="form-control" id="exampleInputPassword1" placeholder="Data em que foi consumada a entrega" value="{{old('date_delivery')}}">
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
            <h3 class="box-title">Lista de Fornecimento</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Fornecedor</th>
                        <th>Produto</th>
                        <th width="80">Quantidade</th>
                        <th>Preço</th>
                        <th>Preço em Dolar</th>
                        <th>Data de entrega</th>
                        <th width="10">Editar</th>
                        <th width="10">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplyingsProducts as $supplyingsProduct)
                        @if ("{$supplyingsProduct->eliminado}" == 'no')
                            <tr>
                                <td>{{$supplyingsProduct->id}}</td>

                                @foreach ($supplyings as $supplying)
                                @if ($supplyingsProduct->supplying == $supplying->id)
                                    <td>
                                        <a href="{{route('admim.supplying.show', $supplying->id)}}">
                                            {{$supplying->name}}
                                        </a>
                                    </td>
                                @endif
                                @endforeach

                                @foreach ($products as $product)
                                @if ($supplyingsProduct->product == $product->id)
                                <td>{{$product->name}}</td>
                                @endif
                                @endforeach

                                <td>{{$supplyingsProduct->qtd}}</td>
                                <td>{{$supplyingsProduct->price}}</td>
                                <td>{{$supplyingsProduct->dolar}}</td>
                                <td>{{$supplyingsProduct->date_delivery}}</td>
                                <td>
                                    <a href="{{route('admim.supplyingProduct.edit', $supplyingsProduct->id)}}" class="fa fa-fw fa-edit"></a>
                                </td>
                                <td>
                                    <a href="{{route('admim.supplyingProduct.destroy', $supplyingsProduct->id)}}" class="fa fa-fw fa-trash-o"></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Fornecedor</th>
                        <th>Produto</th>
                        <th width="80">Quantidade</th>
                        <th>Preço</th>
                        <th>Preço em Dolar</th>
                        <th>Data de entrega</th>
                        <th width="10">Editar</th>
                        <th width="10">Eliminar</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection
