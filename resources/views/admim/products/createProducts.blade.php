@extends('admim.master.layout')

@section('title', 'Gestão de Livros')
@section('pageHeader', 'Gestão de Livros')


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
                        <h3 class="box-title">Cadastrar Livros</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form id="form" action="{{route('admim.products.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do livro" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label>Subcategoria</label>
                                <select name="subcategorie" id="subcategorie" class="form-control select2" style="width: 100%;">
                                    <option value="">Selecione uma sub-categoria</option>
                                    @foreach ($subcategories as $subcategorie)
                                    @if ($subcategorie->eliminado == 'no')
                                        <option value="{{$subcategorie->id}}">{{$subcategorie->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Especialidade</label>
                                <select name="brand" id="brand" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Preço</label>
                                <input  type="text" name="old_price" class="form-control" id="price" placeholder="Preço do livro" value="{{old('old_price')}}" >
                            </div>

                            <input name="dolar" type="hidden" value="">

                            <div class="form-group">
                                <label for="exampleInputPassword1">Desconto</label>
                                <input name="discount" type="number" class="form-control" id="exampleInputPassword1" placeholder="Desconto do livro, caso haja algum" value="{{old('discount')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Quantidade</label>
                                <input name="qtd" type="number" class="form-control" id="exampleInputPassword1" placeholder="Quantidade em stock" value="{{old('qtd')}}">
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
                                            <textarea name="description"  class="textarea" placeholder="Descrição do livro"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Imagem do livro</label>
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
                            <button type="submit" class="btn btn-success" id="form">Cadastrar</button>
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
            <h3 class="box-title">Lista de Livros</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Sub-categoria</th>
                        <th>Preço</th>
                        <th>Preço em Dollar</th>
                        <th width="80">Qtd Inicial</th>
                        <th width="80">Qtd</th>
                        <th>Status</th>
                        <th width="10">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            <a href="{{route('admim.products.show', $product->id)}}">
                                {{$product->name}}
                            </a>
                        </td>

                        @foreach ($subcategories as $subcategorie)
                        @foreach ($categories as $categorie)
                        @if ($subcategorie->categorie == $categorie->id && $subcategorie->id == $product->subcategorie)
                        <td>{{$categorie->description}}</td>
                        @endif
                        @endforeach
                        @endforeach

                        @foreach ($subcategories as $subcategorie)
                        @if ($subcategorie->id == $product->subcategorie)
                        <td>{{$subcategorie->name}}</td>
                        @endif
                        @endforeach

                        <td>{{number_format($product->new_price, 2, ',', ' ')}}</td>
                        <td>{{number_format($product->dolar, 2, ',', ' ')}}</td>
                        <td>{{$product->qtd_init}}</td>
                        <td>{{$product->qtd}}</td>
                        <td>{{$product->status}}</td>
                        @can('Editar Produtos')
                        <td>
                            <a href="{{route('admim.products.edit', $product->id)}}" class="fa fa-fw fa-edit"></a>
                        </td>
                        @else
                        <td>
                            <i class="fa fa-fw fa-edit"></i>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Sub-categoria</th>
                        <th>Preço</th>
                        <th>Preço em Dollar</th>
                        <th width="80">Quantidade</th>
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

@push('scriptsProducts')
    <script src=" {{asset('js/jquery.inputmask.min.js')}} " ></script>

    <script>
        $(document).ready(function(){
            $("#price").inputmask( 'currency',{"autoUnmask": true,
                radixPoint:",",
                groupSeparator: ".",
                allowMinus: false,
                prefix: 'KZ ',
                digits: 2,
                digitsOptional: false,
                rightAlign: false,
                unmaskAsNumber: true,
                removeMaskOnSubmit: true,
                numericInput: true,
            });
        });

    </script>
@endpush
