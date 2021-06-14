@extends('site.master.layout')

@section('title', 'Início')

@section('content')


@php $count = 1; @endphp

@push('carousel')

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    {{-- <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> --}}

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

        <div class="item active">
            <img src="{{asset('site/img/trutaa.png')}}" class="imageShow" alt="Chania">
            <div class="carousel-caption">
                <div class="hot-deal">
                    <h5 class="tt"><p>No Trutaa Bla bla bla bla bla bla bla bla bla.</p></h5>
                    <h5>Encontre os melhores livros aqui.</h5>
                </div>
            </div>
        </div>

        @foreach ($slideProducts as $slideProduct)
        <div class="item">
            <img src=" {{url("storage/{$slideProduct->image}")}} " class="imageShow" alt="Chania">
            <div class="carousel-caption">
                <div class="hot-deal">
                    <h5 class="tt"><p>{{$slideProduct->name}}</p></h5>
                    <h5><span>{{number_format($slideProduct->new_price, 2, ',', ' ')}}</span><br>
                        @if ($slideProduct->discount > 0)
                        <del> {{number_format($slideProduct->old_price, 2, ',', ' ')}}</del></h5>
                        @endif

                        @if ($slideProduct->qtd > 0)

                        <form method="POST" action=" {{ route('shopCart.store') }} ">
                            {{ csrf_field() }}
                            @php $colorQtd = 1; @endphp
                            @php $colorProduct = 'Default'; @endphp

                            @forelse ($colors as $color)
                            @if ($color->product == $slideProduct->id)

                            @if($color->qtd >= $colorQtd)
                            @php $colorProduct = $color->name; $colorQtd = $color->qtd; @endphp
                            @endif

                            @endif
                            @empty
                            @php $colorProduct = 'Default'; @endphp
                            @endforelse

                            <input type="hidden" name="color" value=" {{$colorProduct}} ">

                            <input type="hidden" name="qtd" value="1">

                            <input type="hidden" name="id" value=" {{ $slideProduct->id }} ">

                            <button type="submit" class="primary-btn cta-btn"><i class="fa fa-shopping-cart"></i> Comprar</button>
                        </form>
                        @else
                        <div class="add-to-cart">
                            <p style="font-weight: bold; font-size: 18px; color: red;">Esgotado</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endpush

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="fa fa-chevron-left" id="changeSlide"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="fa fa-chevron-right" id="changeSlide"></span>
            <span class="sr-only">Seguinte</span>
        </a>
    </div>


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">DESTAQUES</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Engenharia</a></li>
                                <li><a data-toggle="tab" href="#tab2">Direito</a></li>
                                <li><a data-toggle="tab" href="#tab3">Saúde</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">

                                    @foreach ($products as $product)
                                    @php
                                        $date1 = strtotime( $product->created_at );
                                        $date2 = strtotime(date('Y/m/d H:i'));

                                        $intervalo = abs( $date2 - $date1 ) / 60;
                                    @endphp
                                    <!-- product -->
                                    @if ( ($product->categorie == 1 ) )
                                    @include('site.products.includes.productsSection')
                                    @endif
                                    <!-- /product -->
                                    @php $count += 1; @endphp
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->

                            <!-- tab -->
                            <div id="tab2" class="tab-pane ">
                                <div class="products-slick" data-nav="#slick-nav-99">
                                    @foreach ($products as $product)
                                    @php
                                        $date1 = strtotime( $product->created_at );
                                        $date2 = strtotime(date('Y/m/d H:i'));

                                        $intervalo = abs( $date2 - $date1 ) / 60;
                                    @endphp
                                    <!-- product -->
                                    @if ( ($product->categorie == 4 ) )
                                    @include('site.products.includes.productsSection')
                                    @endif
                                    <!-- /product -->
                                    @php $count += 1; @endphp
                                    @endforeach
                                </div>
                                <div id="slick-nav-99" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->

                            <!-- tab -->
                            <div id="tab3" class="tab-pane ">
                                <div class="products-slick" data-nav="#slick-nav-100">
                                    @foreach ($products as $product)
                                    @php
                                        $date1 = strtotime( $product->created_at );
                                        $date2 = strtotime(date('Y/m/d H:i'));

                                        $intervalo = abs( $date2 - $date1 ) / 60;
                                    @endphp
                                    <!-- product -->
                                    @if ( ($product->categorie == 2 ) )
                                    @include('site.products.includes.productsSection')
                                    @endif
                                    <!-- /product -->
                                    @php $count += 1; @endphp
                                    @endforeach
                                </div>
                                <div id="slick-nav-100" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->

                            <br><br><br><br>

                            @if (isset($promotion))
                                <div class="container">
                                    <img width="100%" src="{{url("storage/{$promotion->image}")}}" alt="publicidade">
                                </div>
                            @endif

                            <!-- SECTION -->
                             {{-- <div class="section">
                                <!-- container -->
                                <div class="container">
                                    <!-- row -->
                                    <div class="row">
                                        <!-- section title -->
                                        <div class="col-md-12">
                                            <div class="section-title">
                                                <h3 class="title">Nossos Serviços</h3>
                                            </div>
                                        </div>
                                        <!-- /section title -->

                                        <!-- Products tab & slick -->
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="products-tabs">
                                                    <!-- tab -->
                                                    <div id="tab2" class="tab-pane fade in active">
                                                        <div class="products-slick" data-nav="#slick-nav-2">
                                                            @foreach ($servicesAll as $serviceAll)
                                                            <!-- service -->
                                                            <div class="col-md-4 col-xs-6">
                                                                @include('site.services.includes.servicesSection')
                                                            </div>
                                                            <!-- /service -->
                                                            @endforeach
                                                        </div>
                                                        <div id="slick-nav-2" class="products-slick-nav"></div>
                                                    </div>
                                                    <!-- /tab -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Products tab & slick -->
                                    </div>
                                    <!-- /row -->
                                </div>
                                <!-- /container -->
                             </div> --}}
                            <!-- /SECTION -->

                            <section>
                                <div class="container">
                                    <div class="section-heading-1">
                                        <h2>Leitura da semana (Título)</h2>
                                        <p>Uma descrição muiro breve sobre a leituara!!! Muito breve mesmo.</p>
                                        <div class="kode-icon"><i class="fa fa-book"></i></div>
                                    </div>
                                    <div class="bb-custom-wrapper">
                                        <div id="bb-bookblock" class="bb-bookblock">
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 1</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 2</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p><p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 3</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 4</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p><p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 5</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 6</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p><p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 7</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 8</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p><p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 9</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>Chepter 10</h3>
                                                    <p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p><p>Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie. Pastry bear claw oat cake danish croissant jujubes danish. Wypas soufflé muffin. Liquorice powder pastry danish. Candy toffee gummi bears chocolate bar lollipop applicake chocolate cake danish brownie.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <nav>
                                            <a id="bb-nav-prev" href="index.html#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
                                            <a id="bb-nav-next" href="index.html#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
                                        </nav>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">MAIS COMPRADOS</h4>
                            <div class="section-nav">
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-3">
                            @foreach ($moreBought as $mBought)
                            <div>
                                <!-- product widget -->
                                <a href="{{route('product.show', $mBought->id)}}">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src=" {{url("storage/{$mBought->image}")}} " alt="{{$mBought->name}}">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$mBought->brand}}</p>
                                            <h3 class="product-name">{{$mBought->name}}</h3>
                                            <h4 class="product-price">AKZ {{ number_format($mBought->new_price, 2, ',', ' ')}}
                                                @if ($mBought->discount != null)
                                                <del class="product-old-price">{{ number_format($mBought->old_price, 2, ',', ' ')}}</del>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                                <!-- product widget -->
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">MELHORES DESCONTOS</h4>
                            <div class="section-nav">
                                <div id="slick-nav-4" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-4">
                            @foreach ($bestsDiscount as $bestDiscount)
                            <div>
                                <!-- product widget -->
                                <a href="{{route('product.show', $bestDiscount->id)}}">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{url("storage/{$bestDiscount->image}")}} " alt="{{$bestDiscount->name}}">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$bestDiscount->brand}}</p>
                                            <h3 class="product-name">{{$bestDiscount->name}}</h3>
                                            <h4 class="product-price">AKZ {{ number_format($bestDiscount->new_price, 2, ',', ' ')}}
                                                @if ($bestDiscount->discount != null)
                                                <del class="product-old-price">{{ number_format($bestDiscount->old_price, 2, ',', ' ')}}</del>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                                <!-- product widget -->
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    @endsection


    @push('stylesProducts')
    <style>
        .direct-chat-messages {
            -webkit-transform: translate(0, 0);
            -ms-transform: translate(0, 0);
            -o-transform: translate(0, 0);
            transform: translate(0, 0);
            padding: 10px;
            height: 250px;
            overflow: auto;
        }
    </style>
@endpush

@push('stylesBookReader')
    <!-- CUSTOM STYLE -->
    <link href="{{asset('site/css/book_reader/style.css')}}" rel="stylesheet">
    <!-- Component -->
    <link rel="stylesheet" type="text/css" href="{{asset('site/css/book_reader/bookblock.css')}}" />
@endpush

@push('scriptsBookReader')
    <script src="{{asset('site/js/book_reader/modernizr.custom.js')}}"></script>
    <script src="{{asset('site/js/book_reader/jquery.bookblock.js')}}"></script>
    <script src="{{asset('site/js/book_reader/functions.js')}}"></script>
@endpush
