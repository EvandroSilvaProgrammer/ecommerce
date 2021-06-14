<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content=" {{ csrf_token() }} ">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>@yield('title') - Trutaa Livraria online</title>

    @stack('stylesBookReader')

    @stack('stylesProducts')

    @stack('checkoutStyle')

    @stack('StyleCart')

    @stack('clientRegister_Styles')



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

    <link type="text/css" rel="stylesheet" href="{{asset('site/css/simera.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{asset('site/css/jquery-ui.min.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{asset('site/css/newStyleSkeBug.css')}}"/>

    <link rel="shortcut icon" href="{{asset('site/img/icon.ico')}}" />

    <style>

        .whatsapp-link {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 1px 1px 2px #888;
            z-index: 1000;
        }

        .fa-whatsapp {
            margin-top: 10px;
            width: 50px;
            height: 50px;
        }

        /*Smartphone*/
        @media only screen and (max-width: 480px)
        {
            .whatsapp-link{
                right: 10px;
            }
        }

    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        @include('site.master.includes.msgs')

        <!-- HEADER -->
        <header>
            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                @foreach ($contacts as $contact)
                    <ul class="header-links pull-left">
                        <li><a href="#"><i class="fa fa-phone"></i> +244 {{ number_format($contact->phone_number, 0, '', ' ')}} </a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> {{ $contact->email }} </a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i> {{ $contact->adress }} </a></li>
                    </ul>
                @endforeach
                    <ul class="header-links pull-right">
                        @if ((Auth::guard('client')->check() === true))
                        <li><a href=" {{route('client.profile')}} "><i class="fa fa-user-o"></i> {{Auth::guard('client')->user()->name }}</a></li>
                        <li><a href="{{route('client.logout')}}"><i class="fa fa-power-off"></i>SAIR</a></li>
                        @else
                        <li><a href="#" data-toggle="modal" data-target="#modal-client-login"><i class="fa fa-lock"></i>Entrar</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-client-register"><i class="fa fa-user-plus"></i>Registrar</a></li>
                        @endif

                        @include('site.client.login')
                        @include('site.client.register')

                        @if ((isset($productsSession)))
                            @include('site.client.checkoutRegister')
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /TOP HEADER -->

            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="{{route('products.showHome')}}" class="logo">
                                    <img src="{{asset('site/img/logo.png')}}" alt="" style="width: 250px; heigth: 150px">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-6">
                            <div class="header-search">
                                <div class="form-group">
                                    <form action="{{route('site.search')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input class="input" name="product" id="product_search"
                                        @if (Auth::guard('client')->check() === true)
                                        placeholder=" {{Auth::guard('client')->user()->name}}, o que procuras? "
                                        @else
                                        placeholder="Visitante, o que procuras?"
                                        @endif

                                        value="{{ $filters['product'] ?? '' }}">

                                        <button type="submit" class="search-btn">Procurar</button>
                                    </form>
                                    <div id="product_list"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">

                                @if (Auth::guard('client')->check() === true)

                                <!-- Wishlist -->
                                <div>
                                    <a href="{{route('shopCart.purchases')}}">
                                        <i class="fa fa-calendar-o"></i>
                                        <span>Minhas lista de compras</span>
                                    </a>
                                </div>
                                <!-- /Wishlist -->

                                <!-- Cart -->
                                <div class="dropdown">

                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Carrinho de Compras</span>
                                        <div id="qty" class="qty">0</div>
                                    </a>

                                    @foreach ($requests as $request)
                                    @php
                                    $total_itens = 0;
                                    $total_pedido = 0;
                                    @endphp

                                    <div class="cart-dropdown">
                                        <div class="cart-list">
                                            @foreach ($request->RequestProduct as $RP)
                                            <div class="product-widget">
                                                <a href="{{route('product.show', $RP->product->id)}}">
                                                    <div class="product-img">
                                                        <img src="{{url("storage/{$RP->product->image}")}}" alt="{{ $RP->product->name }}">
                                                    </div>
                                                <a>

                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="{{route('product.show', $RP->product->id)}}">{{ $RP->product->name }}</a></h3>
                                                    <h4 class="product-price">
                                                        <span class="qty">{{$RP->qtd}}</span>
                                                        AKZ {{ number_format($RP->product->new_price*$RP->qtd, 2, ',', '.') }}
                                                    </h4>
                                                </div>
                                            </div>
                                            @php
                                            $total_produto = $RP->product->new_price*$RP->qtd;
                                            $total_itens+=$RP->qtd;
                                            $total_pedido += $total_produto;
                                            @endphp
                                            @endforeach
                                        </div>
                                        <div class="cart-summary">
                                            <small >{{ $total_itens}} itens selecionados</small>
                                            <input id="total-itens" type="hidden" value="{{ $total_itens}}">
                                            <h5>SUBTOTAL: AKZ {{ number_format($total_pedido, 2, ',', '.') }}</h5>
                                        </div>
                                        <div class="cart-btns">
                                            <a href="{{route('shopCart.index')}}">Ver carrinho</a>
                                            <a href="{{route('shopCart.checkout')}}">Finalizar<i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /Cart -->
                                @endif


                                @if (Auth::guard('client')->check() === false && isset($productsSession))

                                <!-- Cart -->
                                <div class="dropdown">

                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Carrinho de Compras</span>
                                        <div id="qty" class="qty">0</div>
                                    </a>

                                    <div class="cart-dropdown">
                                        <div class="cart-list">
                                            @php
                                            $total_itens = 0;
                                            $total_pedido = 0;
                                            @endphp
                                            @foreach (Session::get("cart") as $item)
                                            <div class="product-widget">
                                                <a href="{{route('product.show', $item["id"] )}}">
                                                    <div class="product-img">
                                                        <img src="{{url("storage/{$item["image"]}")}}" alt="{{ $item["name"] }}">
                                                    </div>
                                                <a>

                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="{{route('product.show', $item["id"])}}">{{ $item["name"] }}</a></h3>
                                                    <h4 class="product-price">
                                                        <span class="qty">{{$item["qtd"]}}</span>
                                                        AKZ {{ number_format($item["new_price"]*$item["qtd"], 2, ',', '.') }}
                                                    </h4>
                                                </div>
                                            </div>
                                            @php
                                            $total_produto = $item["new_price"]*$item["qtd"];
                                            $total_itens += $item["qtd"];
                                            $total_pedido += $total_produto;
                                            @endphp
                                            @endforeach
                                        </div>
                                        <div class="cart-summary">
                                            <small >{{ $total_itens}} itens selecionados</small>
                                            <input id="total-itens" type="hidden" value="{{ $total_itens}}">
                                            <h5>SUBTOTAL: AKZ {{ number_format($total_pedido, 2, ',', '.') }}</h5>
                                        </div>
                                        <div class="cart-btns">
                                            <a href="{{route('shopCart.index')}}">Ver carrinho</a>

                                            <a href="#" id="end-session" >Finalizar<i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Cart -->
                                @endif

                                <!-- Menu Toogle -->
                                <div class="menu-toggle">
                                    <a href="#">
                                        <i class="fa fa-bars"></i>
                                        <span>Menu</span>
                                    </a>
                                </div>
                                <!-- /Menu Toogle -->
                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->

        <!-- NAVIGATION -->
        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">
                    <!-- NAV -->
                    <ul class="main-nav nav navbar-nav">
                        @include('site.master.includes.menubar')
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
        <!-- /NAVIGATION -->

         @if ((isset($productsSession)))
            @include('site.client.checkout')
        @endif


        @stack('carousel')


        @yield('content')

        <!-- NEWSLETTER -->
        <div id="newsletter" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <p>Todas as Novidades <strong>Trutaa </strong>no seu Email</p>
                            <form action="{{route('newslleter.store')}}" method="POST" enctype="multipart/form-data" role="form">
                                @csrf
                                <input class="input" name="email" type="email" placeholder="Insira o seu email">
                                <button class="newsletter-btn" type="submit"><i class="fa fa-envelope"></i> Subscreva</button>
                            </form>
                            <ul class="newsletter-follow">
                                <li>
                                    <a href="https://www.facebook.com/trutaa.tecnologies/" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://api.whatsapp.com/send?phone=244940047896&text=&source=&data=&app_absent=" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/company/trutaa/" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /NEWSLETTER -->


        <a class="whatsapp-link" href="https://api.whatsapp.com/send?phone=244940047896&text=&source=&data=&app_absent=" target="_blank">
            <i class="fa fa-whatsapp"></i>
        </a>


        <div class="fab">
            <input type="button" class="btnUP" name="Subir">
        </div>
        <!-- FOOTER -->
        <footer id="footer">
            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-4 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Trutaa</h3>
                                <p>BLA BLA BLA BLA BLA BLA</p><br><br>
                                <ul class="footer-links">
                                    <li><a href="{{route('aboutUs.info')}}">Sobre Nós</a></li>
                                    <li><a href="{{route('terms.info')}}">Termos e Condições</a></li>
                                </ul>

                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Categorias</h3>
                                <ul class="footer-links">
                                    @foreach ($categories as $categorie)
                                    <li><a href="{{route('categorie.show', $categorie->id)}}">{{$categorie->description}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Informações</h3>
                                @foreach ($contacts as $contact)
                                    <ul class="footer-links">
                                        <li><a href="#"><i class="fa fa-map-marker"></i>{{ $contact->adress }}</a></li>
                                        <li><a href="#"><i class="fa fa-phone"></i>+244 {{ number_format($contact->phone_number, 0, '', ' ')}}</a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i>{{ $contact->email }}</a></li>
                                    </ul>
                                @endforeach

                            </div>
                        </div>

                        {{--
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Serviços</h3>
                                <ul class="footer-links">
                                    @foreach ($services as $service)
                                    <li><a href="{{route('service.show', $service->id)}}">{{$service->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        --}}

                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->

            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy; <script>document.write(new Date().getFullYear());</script> Todos os direitos reservados | <a href="{{route('products.showHome')}}" style="font-size: 14px; color: #ccc">Trutaa</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </span>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bottom footer -->
        </footer>
        <!-- /FOOTER -->

        <!-- jQuery Plugins -->

        <script src="{{asset('site/js/jquery.min.js')}}"></script>
        <script src="{{asset('site/js/menu.js')}}"></script>
        <script src="{{asset('site/js/jquery-ui.min.js')}}"></script>

        @stack('scriptsProducts')

        @stack('ScriptCart')

        @stack('checkoutScript')

        @stack('loginScript')

        @stack('clientRegister_Script')

        @stack('scriptsBookReader')

        <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('site/js/slick.min.js')}}"></script>
        <script src="{{asset('site/js/nouislider.min.js')}}"></script>
        <script src="{{asset('site/js/jquery.zoom.min.js')}}"></script>
        <script src="{{asset('site/js/main.js')}}"></script>


        <script type="text/javascript">


            $(document).ready(function(){

                $('#product_search').keyup(function(){

                    var query = $(this).val();

                    if(query != '')
                    {
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url:"{{ route('site.search.product') }}",
                            method: "POST",
                            data:{query:query, _token:_token},
                            success:function(data)
                            {
                                $('#product_list').fadeIn();
                                $('#product_list').html(data);
                            }
                        })

                    }
                });

                $(document).on('click', 'li', function(){
                    $('#product_search').val($(this).text());
                    $('#product_list').fadeOut();
                });

            });

        </script>



    </body>
    </html>

