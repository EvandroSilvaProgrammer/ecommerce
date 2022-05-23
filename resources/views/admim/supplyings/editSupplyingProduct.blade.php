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
                        <h3 class="box-title">Actualizar Fornecimento</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.supplyingProduct.update', $supplyingProduct->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label>Fornecedor</label>
                                <select name="supplying" class="form-control select2" style="width: 100%;">
                                    @foreach ($supplyings as $supplying)
                                        @if ($supplying->eliminado == 'no')
                                            @if ($supplying->id == $supplyingProduct->supplying)
                                                <?php $supplyingSelectedName = $supplying->name ?>
                                                <?php $supplyingSelectedId = $supplying->id ?>
                                            @endif
                                            <option value="{{$supplying->id}}">{{$supplying->name}}</option>
                                        @endif
                                    @endforeach
                                    <option selected="selected" value="{{$supplyingSelectedId}}">{{$supplyingSelectedName}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Livro</label>
                                <select name="product" class="form-control select2" style="width: 100%;">
                                    @foreach ($products as $product)
                                        @if ($product->eliminado == 'no')
                                             @if ($product->id == $supplyingProduct->product)
                                                <?php $productSelectedName = $product->name ?>
                                                <?php $productSelectedId = $product->id ?>
                                            @endif
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endif
                                    @endforeach
                                    <option selected="selected" value="{{$productSelectedId}}">{{$productSelectedName}}</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Quantidade</label>
                                <input name="qtd" type="number" class="form-control" id="exampleInputPassword1" placeholder="Quantidade fornecida" value="{{$supplyingProduct->qtd}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço</label>
                                <input name="price" type="number" class="form-control" id="exampleInputPassword1" placeholder="Preço do total fornecido" value="{{$supplyingProduct->price}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço em Dolar</label>
                                <input name="dolar" type="number" class="form-control" id="exampleInputPassword1" placeholder="Preço em dolar" value="{{$supplyingProduct->dolar}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Data de entrega</label>
                                <input name="date_delivery" type="date" class="form-control" id="exampleInputPassword1" placeholder="Data em que foi consumada a entrega" value="{{$supplyingProduct->date_delivery}}">
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
