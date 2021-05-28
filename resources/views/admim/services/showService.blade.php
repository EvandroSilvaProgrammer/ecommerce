<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="{{asset('site/css/bootstrap.min.css')}}"/>

<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{asset('site/css/slick.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('site/css/slick-theme.css')}}"/>

<!-- nouislider -->
<link type="text/css" rel="stylesheet" href="{{asset('site/css/nouislider.min.css')}}"/>

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="{{asset('site/css/font-awesome.min.css')}}">

<!-- Custom stlylesheet -->

<link type="text/css" rel="stylesheet" href="{{asset('site/css/style.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('site/css/newStyleSkeBug.css')}}"/>


@extends('admim.master.layout')


@section('title', 'Gestão de Produtos')
@section('pageHeader', "{$service->name}")

@section('content')
<?php $plugin=1; ?>
<!-- Main content -->
<section class="content container-fluid">
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <!-- Main img -->
                        <div class="product-preview">
                            <img src="{{ url("storage/{$service->image}") }}" alt="{{$service->name}}">
                        </div>
                        <!-- /Main img -->

                        <!-- Extra imgs -->
                        @foreach ($extraImages as $extraImage)
                        <div class="product-preview">
                            <img src="{{url("storage/{$extraImage->image}")}}" alt="{{$service->name}}">
                        </div>
                        @endforeach
                        <!-- /Extra imgs -->

                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <!-- Main img -->
                        <div class="product-preview">
                            <img src="{{url("storage/{$service->image}")}}" alt="{{$service->name}}">
                        </div>
                        <!-- /Main img -->

                        <!-- Extra imgs -->
                        @foreach ($extraImages as $extraImage)
                        <div class="product-preview">
                            <div class="product-label">
                                @can('Apagar Imagens do Serviço')
                                    <a href="{{route('admim.services.addImage.destroy', $extraImage->id)}}" class="fa fa-trash-o"><span class="new"></span></a>
                                @endcan
                            </div>
                            <img src="{{url("storage/{$extraImage->image}")}}" alt="{{$service->name}}">
                        </div>
                        @endforeach
                        <!-- /Extra imgs -->
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$service->name}}</h2>

                        <ul class="product-links">
                            <li>Status:</li>
                            <li>{{$service->status}}</li> <br> <br>

                            <li>Desconto:</li>
                            <li>{{$service->discount}}%</li> <br> <br>

                        </ul> <br>

                        @can('Adicionar Imagens ao Serviço')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-image-service" class="add-to-cart-btn"><i class="fa fa-fw fa-file-image-o"></i>Adicionar mais imagens</button>
                            </div>
                        @endcan

                        @can('Editar Serviços')
                            <div class="add-to-cart">
                                <a href="{{route('admim.services.edit', $service->id)}}">
                                    <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Editar Serviço</button>
                                </a>
                            </div>
                        @endcan

                        @can('Apagar Serviços')
                            <div class="add-to-cart">
                                <button data-toggle="modal" data-target="#modal-service" class="add-to-cart-btn"><i class="fa fa-trash-o"></i>Remover Serviço</button>
                            </div>
                        @endcan

                        @include('admim.services.includes.modalConfirmRemoval')
                        @include('admim.services.includes.modalAddImage')

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Descrição</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{$service->description}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</section>
<!-- /.content -->
@endsection
