@extends('admim.master.layout')

@section('title', 'Gestão de Produtos')
@section('pageHeader', 'Gestão de Produtos')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @can('Alterar Contactos')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Alterar Contactos</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    @include('admim.master.includes.errorsList')

                    <form action="{{route('admim.contacts.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nº de Telefone</label>
                                <input name="phone_number" type="number" class="form-control" id="exampleInputEmail1" placeholder="Número de Telefone" value="{{old('phone_number')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Endereço</label>
                                <input name="adress" type="text" class="form-control" id="exampleInputPassword1" placeholder="Endereço" value="{{old('adress')}}">
                            </div>

                        </div>
                        <!-- /.box-body -->

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


    @can('Visualizar Contactos')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Contactos Actuais</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div  style="width: 80%; margin-left: 10% ">
                @foreach ($contacts as $contact)
                <b>
                    Nº de telefone: +244 {{ number_format($contact->phone_number, 0, '', ' ')}} <br><br>
                    Email: {{ $contact->email }} <br><br>
                    Endereço: {{ $contact->adress }}
                </b>
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
