<div class="main_nav_menu ml-auto">
    <ul class="standard_dropdown main_nav_dropdown">
        <li class="hassubs"><a class="@if((Route::current()->getName() === 'products.showHome') ) active @endif " href="{{route('products.showHome')}}"><i class="fa fa-home"></i> HOME </a></li>

        <li class="hassubs">
            <a class="@if((Route::current()->getName() === 'products.index') ) active @endif
                @if((Route::current()->getName() === 'categorie.show') ) active  @endif
                @if((Route::current()->getName() === 'product.show') ) active  @endif
                @if((Route::current()->getName() === 'subcategorie.show') ) active  @endif" href="{{route('products.index')}}">
                <i class="fa fa-cubes"></i> LIVROS </a>
            <ul>
                @foreach ($categories as $categorie)
                <li class="hassubs">
                    <a href="{{route('categorie.show', $categorie->id)}}">{{--  <i class="fa fa-cubes"></i>  --}} {{$categorie->description}} </a>
                    <ul>
                        @foreach ($subcategories as $subcategorie)
                        @if ($subcategorie->categorie == $categorie->id)
                        <li class="hassubs">
                            <a href="{{route('subcategorie.show', $subcategorie->id)}}">
                                {{--  <i class="fa fa-cubes"></i>  --}}{{$subcategorie->name}}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>

        {{--
        <li class="hassubs">
            <a class="@if((Route::current()->getName() === 'services.index') ) active @endif
                @if((Route::current()->getName() === 'service.show') ) active  @endif" href="{{route('services.index')}}">
                <i class="fa fa-tasks"></i> SERVIÇOS</a>
            <ul>
                @foreach ($services as $service)
                <li class="hassubs">
                    <a href="{{route('service.show', $service->id)}}">
                        <i class="fa fa-tasks"></i> {{$service->name}}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        --}}

        <li class="hassubs">
            <a class="@if((Route::current()->getName() === 'promotion.index') ) active @endif" href=" {{route('promotion.index')}} "> <i class="fa fa-star"></i> Promoções</a>
        </li>
    </ul>
</div>
