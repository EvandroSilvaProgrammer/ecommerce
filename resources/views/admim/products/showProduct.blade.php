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
@section('pageHeader', "{$product->name}")

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
                            <img src="{{ url("storage/{$product->image}") }}" alt="{{$product->name}}">
                        </div>
                        <!-- /Main img -->

                        <!-- Extra imgs -->
                        @foreach ($extraImages as $extraImage)
                        <div class="product-preview">
                            <img src="{{url("storage/{$extraImage->image}")}}" alt="{{$product->name}}">
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
                            <img src="{{url("storage/{$product->image}")}}" alt="{{$product->name}}">
                        </div>
                        <!-- /Main img -->

                        <!-- Extra imgs -->
                        @foreach ($extraImages as $extraImage)
                        <div class="product-preview">
                            <div class="product-label">
                                <a href="{{route('admim.products.addImage.destroy', $extraImage->id)}}" class="fa fa-trash-o"><span class="new"></span></a>
                            </div>
                            <img src="{{url("storage/{$extraImage->image}")}}" alt="{{$product->name}}">
                        </div>
                        @endforeach
                        <!-- /Extra imgs -->
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$product->name}}</h2>

                        <div>

                            <h3 class="product-price"> {{number_format($product->new_price, 2, ',', ' ')}} AKZ @if ($product->discount != 0)<del class="product-old-price">{{$product->old_price}} AKZ</del></h3>@endif
                            <span class="product-available">@if ($product->qtd<=0)
                                    STOCK VAZIO
                                    @else
                                    EM STOCK
                                @endif
                            </span>
                        </div>

                        <ul class="product-links">
                            <li>Status:</li>
                            @if ($product->status === 'Offline')
                                <li>{{$product->status}}</li> <a href="{{route('admim.product.online', $product->id)}}"> <br> Colocar online <i class="fa fa-toggle-off"></i> </a> <br> <br>
                            @endif

                            @if ($product->status === 'online')
                            <li>{{$product->status}}</li> <a href="{{route('admim.product.offline', $product->id)}}"> <br> Colocar offline <i class="fa fa-toggle-off"></i> </a> <br> <br>
                            @endif

                            @foreach ($categories as $categorie)
                                <li>Categoria:</li>
                                <li>{{$categorie->name}}</li> <br> <br>
                            @endforeach

                            <li>Subcategoria:</li>
                            <li>{{$subcategorie}}</li> <br> <br>

                            <li>Marca:</li>
                            <li>{{$brand}}</li> <br> <br>

                            <li>Preço em Dolar:</li>
                            <li>{{number_format($product->dolar, 2, ',', ' ')}} USD</li> <br> <br>

                            <li>Desconto:</li>
                            <li>{{$product->discount}}%</li> <br> <br>

                            <li>Quantidade:</li>
                            <li>{{$product->qtd}}</li> <br>

                            {{-- @php  $colorib=0? @endphp

                            @foreach ($colorQtds as $colorQtd)

                            @php $colorib=$colorib+$colorQtd->qtd @endphp

                            @foreach ($colors as $color)
                            @if ($colorQtd->color == $color->id)
                            <li class="colorCategorie"><a id="trashColor" href="{{route('admim.productColors.destroy', $colorQtd->color)}}"><i class="fa fa-trash-o"></i></a>{{ $color->color}}:</li>
                            <li>{{$colorQtd->qtd}}</li> <br>
                            @endif
                            @endforeach

                            @endforeach

                            @if ("{$colorib}" > "{$product->qtd}")
                            <div class="qtdError">
                                SUA QUANTIDADE DE PRODUTOS POR COR <br> É MAIOR QUE A QUANTIDADE TOTAL CADASTRADA
                            </div>
                            @endif --}}

                        </ul> <br>

                        <div class="add-to-cart">
                            <button data-toggle="modal" data-target="#modal-success" class="add-to-cart-btn"><i class="fa fa-fw fa-file-image-o"></i>Adicionar mais imagens</button>
                        </div>

                        <div class="add-to-cart">
                            <button data-toggle="modal" data-target="#modal-detail" class="add-to-cart-btn"><i class="fa fa-fw fa-file-image-o"></i>Adicionar Detalhes</button>
                        </div>


                        {{-- @if ("{$colorib}" < "{$product->qtd}")
                        <div class="add-to-cart">
                            <button data-toggle="modal" data-target="#modal-color" class="add-to-cart-btn"><i class="fa fa-fw fa-tint"></i>Adiciona categoria de cores</button>
                        </div>
                        @endif --}}

                        <div class="add-to-cart">
                            <a href="{{route('admim.products.edit', $product->id)}}">
                                <button class="add-to-cart-btn"><i class="fa fa-fw fa-edit"></i>Editar produto</button>
                            </a>
                        </div>

                        <div class="add-to-cart">
                            <button data-toggle="modal" data-target="#modal-danger" class="add-to-cart-btn"><i class="fa fa-trash-o"></i>Remover produto</button>
                        </div>

                        @include('admim.products.includes.modalAddImage')

                        @include('admim.products.includes.modalConfirmRemoval')

                        {{-- @include('admim.products.includes.modalProductColor') --}}

                        @include('admim.products.includes.modalProductDetails')

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Detalhes</a></li>
                            <li><a data-toggle="tab" href="#tab2">Descrição</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row" >
                                    <div class="col-md-12">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Ficha Informativa</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($details as $detail)
                                                <tr>
                                                    <th scope="row"><i class="fa fa-info-circle"></i> {{$detail->description}}</th>
                                                    <td>{{$detail->info}}</td>
                                                    <td>
                                                        @can('Editar Produtos')
                                                            <a href="{{route('admim.products.addDetail.destroy', $detail->id)}}" class="fa fa-fw fa-trash-o"></a>
                                                        @else
                                                            <i class="fa fa-fw fa-trash-o"></i>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>

                                    </div>


                                </div>
                            </div>
                            <!-- /tab1  -->
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->

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
