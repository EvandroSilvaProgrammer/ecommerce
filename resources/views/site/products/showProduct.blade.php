@extends('site.master.layout')

@section('title', "{$product->name}")

@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "{$product->name}"])

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
                        <img src="{{url("storage/{$product->image}")}}" alt="{{$product->name}}">
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
                    <h2 class="product-name"><b> {{$product->name}}</h2> <br>

                        <div>
                            <h3 class="product-price">{{ number_format($product->new_price, 2, ',', ' ')}} AKZ @if ($product->discount != 0)<del class="product-old-price">{{number_format($product->old_price, 2, ',', ' ')}} AKZ</del></h3>@endif <br>

                            {{--
                                @if ($product->qtd == 0)
                                    <span style="color: red" class="product-available">Stock vazio</span>
                                @endif

                                @if ($product->qtd > 0 && $product->qtd <= 5)
                                    <span style="color: red" class="product-available">Em stock (Restam apenas {{$product->qtd}})</span>
                                @endif

                                @if ($product->qtd > 0 && $product->qtd > 5)
                                    <span class="product-available"><i class="fa fa-check-circle"></i> Em stock</span>
                                @endif
                            --}}

                            <h5> Contravalor (USD) {{ number_format($product->dolar, 2, ',', ' ')}} USD</h5>
                            <p>Preço com IVA incluido à taxa em vigor</p>

                        </div> <br>
                        <span class="product-available"><i class="fa fa-check-circle"></i> Disponível</span> Entrega estimada em 15 dias depois do pagamento do livro. <br> <br>

                        {{--
                            <span class="product-available"><i class="fa fa-truck"></i> Entrega Gratuíta</span> Para encomendas acima de 10 000 AKZ
                            <br><br> <br>
                        --}}

                        <div class="add-to-cart">

                            @if ($product->qtd != 0)
                                <form method="POST" action=" {{ route('shopCart.store') }} ">
                                    {{ csrf_field() }}
                                    <label>
                                        {{-- Cor --}}
                                        <select style="display: none" name="color" class="input-select">
                                            @forelse ($colors as $color)
                                            @if ($color->qtd != 0)
                                            <option value="{{$color->name}}">{{$color->name}}</option>
                                            @endif
                                            @empty
                                            <option value="Default">Default</option>
                                            @endforelse
                                        </select>
                                    </label>

                                    <div class="qty-label">
                                        <label>
                                            Quantidade
                                            <div class="input-number price-min">
                                                <input name="qtd" id="price-min" type="number" value="1">
                                                <span class="qty-up">+</span>
                                                <span class="qty-down">-</span>
                                            </div>
                                        </label>
                                    </div>  <br> <br> <br>

                                    <input type="hidden" name="id" value=" {{ $product->id }} ">

                                    <div class="add-to-cart" style="margin-left: 45px;">
                                        <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</button>
                                    </div>
                                </form>
                            @endif

                        </div>

                        <ul class="product-btns">
                            <ul class="product-links">
                                <li>Categoria:</li>
                                @foreach ($categorie as $cg)
                                <li>
                                    <a href="{{route('categorie.show', $cg->id)}}">{{$cg->description}}</a>
                                    @foreach ($subcategories as $subcategorie)
                                    @if ($subcategorie->id == $product->subcategorie)
                                    >
                                    <a href="{{route('subcategorie.show', $subcategorie->id)}}">{{$subcategorie->name}}</a>
                                    @endif
                                    @endforeach
                                </li>
                                @endforeach
                            </ul>

                            @php
                                $protocolo = (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') ? 'http' : 'https';
                                $url = "$protocolo://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                            @endphp

                            <ul class="product-links">
                                <li>Partilhar:</li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{$url}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?url={{$url}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://api.whatsapp.com/send?text={{$url}}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>

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
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

        <!-- Section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h3 class="title">Livros Relacionados</h3>
                        </div>
                    </div>

                    @php $count = 1; @endphp
                    @foreach ($products as $product)
                    <!-- product -->
                    <div class="col-md-3 col-xs-6">
                        @include('site.products.includes.productsSection')
                    </div>
                    <!-- /product -->
                    @php $count += 1; @endphp
                    @endforeach
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /Section -->

        @endsection
