@extends('site.master.layout')

@section('title', "{$subcategorie->name}")


@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "{$subcategorie->name}"])

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store products -->
                <div class="row">
                    @php $count = 1; @endphp
                    @foreach ($products as $product)
                    <!-- product -->
                    <div class="col-md-4 col-xs-6">
                        @include('site.products.includes.productsSection')
                    </div>
                    <!-- /product -->
                    @php $count += 1; @endphp
                    @endforeach

                    @if ($count <= 1)
                    <p style="color: red; font-weight: bold; font-size: 20px; margin-left: 2%; line-height: 40px;" >
                        Não foram encontrados resultados para a sua pesquisa! Por favor, reveja os campos selecionados e tente novamente. </p>
                        @endif
                    </div>
                    <!-- /store products -->
                    @if (isset($filters))
                    {!! $products->appends($filters)->links() !!}
                    @else
                    {!! $products->links() !!}
                    @endif
                </div>
                <!-- /STORE -->
                <form action="{{route('products.subcategorie.personalizedQuery')}}" method="POST">
                    @csrf

                    <input type="hidden" name="subcategorie" value=" {{$subcategorie->id}} ">
                    <!-- ASIDE -->
                    <div id="aside" class="col-md-3">
                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Preço</h3>
                            {{-- @php $min = 1; @endphp --}}
                            <div class="price-filter">
                                <div id="price-slider"></div>
                                <div class="input-number price-min">
                                    <input id="price-min" name="price_min" type="text"
                                    @if(isset($filters['price_min']))
                                    value=" {{ $filters['price_min'] }} "
                                    @else
                                    value=" 0 "
                                    @endif
                                    >
                                </div>

                                <span>-</span>

                                <div class="input-number price-max">
                                    <input id="price-max" name="price_max" type="text"
                                    @if(isset($filters['price_max']))
                                    value=" {{ $filters['price_max'] }} "
                                    @else
                                    value=" 50000000 "
                                    @endif
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Especialidades</h3>

                            <!-- DIRECT CHAT SUCCESS -->
                            <div class="box box-success direct-chat direct-chat-success">
                                <div class="box-header with-border">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- Conversations are loaded here -->
                                        <div class="direct-chat-messages">
                                            <div class="checkbox-filter">
                                                @foreach ($brandsSubCategorie as $brandSubCategorie)
                                                <div class="input-checkbox">
                                                    <input type="checkbox" id="brand-{{$brandSubCategorie->id}}" name="brand[]" value=" {{$brandSubCategorie->id}} "

                                                    @if(isset($filters['brand']))
                                                    @foreach ($filters['brand'] as $item)
                                                    @if($item == $brandSubCategorie->id)
                                                    checked
                                                    @endif
                                                    @endforeach
                                                    @endif

                                                    >

                                                    <label for="brand-{{$brandSubCategorie->id}}">
                                                        <span></span>
                                                        {{$brandSubCategorie->name}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!--/.direct-chat -->
                            </div>

                        </div>
                        <!-- /aside Widget -->

                        <div class="search-categories">
                            <button type="submit" class="btn-search-categories"><i class=""></i>Fazer pesquisa personalida</button>
                        </div>
                    </form>

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">MAIS COMPRADOS</h3>
                        @foreach ($moreBought as $mBought)
                        <!-- product widget -->
                        <a href="{{route('product.show', $mBought->id)}}">
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{url("storage/{$mBought->image}")}} " alt="{{$mBought->name}}">
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
                            </div> <br>
                        </a>
                        <!-- product widget -->
                        @endforeach
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

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

    @push('scriptsProducts')
    <script src=" {{asset('js/jquery.inputmask.min.js')}} " ></script>

    <script>

        $(document).ready(function(){
            $("#price-min").inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            digits: 2,
            digitsOptional: false,
            rightAlign: false,
            unmaskAsNumber: true,
            removeMaskOnSubmit: true,
            numericInput: true
        });
    });

    $(document).ready(function(){
        $("#price-max").inputmask( 'currency',{"autoUnmask": true,
        radixPoint:",",
        groupSeparator: ".",
        allowMinus: false,
        digits: 2,
        digitsOptional: false,
        rightAlign: false,
        unmaskAsNumber: true,
        removeMaskOnSubmit: true,
        numericInput: true
    });
});

</script>
@endpush
