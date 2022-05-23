<!-- product -->
<div class="product">
    <div class="product-img">
        @if ($product->image)
            <img src=" {{url("storage/{$product->image}")}} " alt="{{$product->name}}">
        @else
            <img src="{{url("storage/products/capa.jpg")}}" alt="{{$product->name}}">
        @endif

        @php
            $date1 = strtotime( $product->created_at );
            $date2 = strtotime(date('Y/m/d H:i'));

            $intervalo = abs( $date2 - $date1 ) / 60;
        @endphp

        <div class="product-label">
            @if ($product->discount != 0)
                <span class="sale">-{{$product->discount}}%</span>
            @endif
            @if ($intervalo<20160)
                <span class="new">NOVO</span>
            @endif
        </div>
    </div>
    <div class="product-body">
        @foreach ($brands as $brand)
            @if ($brand->id == $product->brand)
                @if ($brand->name != 'Sem especialidade')
                    <p class="product-category">{{$brand->name}}</p>
                @endif
            @endif
        @endforeach

        <h3 class="product-name"><a href="{{route('product.show', $product->id)}}">{{$product->name}}</a></h3>
        <h4 class="product-price">{{number_format($product->new_price, 2, ',', ' ')}} AKZ <br> @if ($product->discount != 0)<del class="product-old-price">{{number_format($product->old_price, 2, ',', ' ')}} AKZ</del></h4>@endif
        <div class="product-btns">
            <button class="quick-view"><a href="{{route('product.show', $product->id)}}"><i class="fa fa-eye"></i><span class="tooltipp">Ver</span></button>
            </a>
        </div>
    </div>

    @if ($product->qtd > 0)

    <form method="POST" action=" {{ route('shopCart.store') }} ">
        {{ csrf_field() }}

        @php $colorQtd = 1; @endphp
        @php $colorProduct = 'Default'; @endphp

        @forelse ($colors as $color)
            @if ($color->product == $product->id)

                @if($color->qtd >= $colorQtd)
                    @php $colorProduct = $color->name; $colorQtd = $color->qtd; @endphp
                @endif

            @endif
        @empty
            @php $colorProduct = 'Default'; @endphp
        @endforelse

        <input type="hidden" name="color" value=" {{$colorProduct}} ">

        <input type="hidden" name="qtd" value="1">

        <input type="hidden" name="id" value=" {{ $product->id }} ">

        <div class="add-to-cart">
            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</button>
        </div>

    </form>
    @else
    <div class="add-to-cart">
        <p style="font-weight: bold; font-size: 18px; color: red;">Esgotado</p>
    </div>
    @endif

</div>
<!-- /product -->


