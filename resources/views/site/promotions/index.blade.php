@extends('site.master.layout')

@section('title', 'Promoções')


@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Promoções"])
@php $count = 1; @endphp

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
                    @foreach ($products as $product)
                    <!-- product -->
                    <div class="col-md-4 col-xs-6">
                        @include('site.products.includes.productsSection')
                    </div>
                    <!-- /product -->
                    @php $count += 1; @endphp
                    @endforeach

                </div>
                <!-- /store products -->

                {!! $products->links() !!}

            </div>
            <!-- /STORE -->

            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
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
