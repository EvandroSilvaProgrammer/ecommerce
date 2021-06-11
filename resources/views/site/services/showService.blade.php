@extends('site.master.layout')

@section('title', "{$service->name}")

@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "{$service->name}"])

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
                        <img src="{{url("storage/{$service->image}")}}" alt="{{$service->name}}">
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
                    <h2 class="product-name"><b> {{$service->name}}</h2> <br>

                        @if ($service->price != '')
                        <div>
                            <h3 class="product-price">{{ number_format($service->price, 2, ',', ' ')}} AKZ @if ($service->discount != 0)<del class="product-old-price">{{number_format($service->price, 2, ',', ' ')}} AKZ</del></h3>@endif
                            <span class="product-available">Em stock</span>
                            <h5> Contravalor (USD) {{ number_format($service->dolar, 2, ',', ' ')}} USD</h5>
                        </div> <br>
                        @endif

                        <div>
                            <span class="product-available"> {{$service->description}} </span>
                        </div> <br>


                        {{-- <span class="product-available"><i class="fa fa-check-circle"></i> Disponível</span> Entrega estimada em 24 à 48H <br>
                        <span class="product-available"><i class="fa fa-truck"></i> Entrega Gratuíta</span> Para encomendas acima de 10 000 AKZ
                        <br><br> <br>

                        <div class="add-to-cart">

                            <div class="add-to-cart" style="margin-left: 45px;">
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</button>
                            </div>

                        </div> --}}

                        <ul class="product-btns">
                            <ul class="product-links">
                                <li>Partilhar:</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            </ul>

                        </div>
                    </div>
                    <!-- /Product details -->

                    {{-- <!-- Product tab -->
                    <div class="col-md-12">
                        <div id="product-tab">
                            <!-- product tab nav -->
                            <ul class="tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Descrição</a></li>
                            </ul>
                            <!-- /product tab nav -->

                            <!-- product tab content -->
                            <div class="tab-content">
                                <!-- tab2  -->
                                <div id="tab1" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{$service->description}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab2  -->

                            </div>
                            <!-- /product tab content  -->
                        </div>
                    </div>
                    <!-- /product tab --> --}}
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

        <!-- Section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3 class="title">Serviços Relacionados</h3>
                        </div>
                    </div>

                    @foreach ($servicesAll as $serviceAll)
                    <!-- product -->
                    <div class="col-md-3 col-xs-6">
                        @include('site.services.includes.servicesSection')
                    </div>
                    <!-- /product -->
                    @endforeach
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /Section -->


        @endsection
