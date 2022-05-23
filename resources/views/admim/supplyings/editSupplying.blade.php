@extends('admim.master.layout')

@section('title', 'Gestão de Fornecedores')
@section('pageHeader', 'Gestão de Fornecedores')


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
                        <h3 class="box-title">Editar Informaões do Fornecedor {{$supplying->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.supplying.update', $supplying->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do fornecedor" value="{{$supplying->name}}">
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
                                    @foreach ($districts as $district)
                                        @if ($district->id == $supplying->district)
                                            <?php $districtSeletecd = $district->name ?>
                                            <?php $districtSeletecdID = $district->id ?>
                                        @endif
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                    <option value="{{$districtSeletecdID}}" selected="selected">{{$districtSeletecd}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Bairro</label>
                                <input name="neighborhood" type="text" class="form-control" id="exampleInputEmail1" placeholder="Bairro do fornecedor" value="{{$supplying->neighborhood}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Rua</label>
                                <input name="street" type="text" class="form-control" id="exampleInputEmail1" placeholder="Rua do fornecedor" value="{{$supplying->street}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Casa</label>
                                <input name="house_number" type="text" class="form-control" id="exampleInputEmail1" placeholder="Número da casa do fornecedor" value="{{$supplying->house_number}}">
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
