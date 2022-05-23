@extends('admim.master.layout')

@section('title', 'Gestão de Fornecedores')
@section('pageHeader', 'Gestão de Fornecedores')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    @can('Cadastrar Fornecedores')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Fornecedores</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.supplying.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do fornecedor" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label>Província</label>
                                <select name="province" id="province" class="form-control select2" style="width: 100%;">
                                    <option value="">Selecione uma Província</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Município</label>
                                    <select name="district" id="district" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Bairro</label>
                                <input name="neighborhood" type="text" class="form-control" id="exampleInputEmail1" placeholder="Bairro do fornecedor" value="{{old('neighborhood')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Rua</label>
                                <input name="street" type="text" class="form-control" id="exampleInputEmail1" placeholder="Rua do fornecedor" value="{{old('street')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Casa</label>
                                <input name="house_number" type="text" class="form-control" id="exampleInputEmail1" placeholder="Número da casa do fornecedor" value="{{old('house_number')}}">
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

    @can('Visualizar Fornecedores')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Fornecedores</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Província</th>
                        <th>Município</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th width="50">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supllyings as $supllying)
                    @if ($supllying->eliminado === 'no')
                        <tr>
                            <td>{{$supllying->id}}</td>
                            <td>
                                <a href="{{route('admim.supplying.show', $supllying->id)}}">
                                    {{$supllying->name}}
                                </a>
                            </td>
                            <td>
                                @foreach ($provinces as $province)
                                    @if ($province->id == $supllying->province)
                                        {{$province->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($districts as $district)
                                    @if ($district->id == $supllying->district)
                                        {{$district->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$supllying->street}}</td>
                            <td>{{$supllying->neighborhood}}</td>
                            @can('Editar Fornecedores')
                                <td>
                                    <a href="{{route('admim.supplying.edit', $supllying->id)}}" class="fa fa-fw fa-edit"></a>
                                </td>
                            @else
                                <td>
                                    <i class="fa fa-fw fa-edit"></i>
                                </td>
                            @endcan

                        </tr>
                    @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Província</th>
                        <th>Município</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th width="50">Editar</th>
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
