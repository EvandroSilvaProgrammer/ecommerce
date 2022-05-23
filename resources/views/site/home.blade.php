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
                    <h5 class="tt"><p>As informações que você deseja das fontes bibliográficas em que você confia.</p></h5>
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
                                <div class="container" style="padding-bottom: 100px;">
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
                                        <h2>Leitura da semana - A Arte da Guerra</h2>
                                        <p>A Arte da Guerra é um dos maiores tratados de estratégia de todos os tempos. Apresentamos aqui uma resenha comentada de um livro que ultrapassou as barreiras do tempo e nos traz ensinamentos que levaremos conosco ao longo da vida na busca de nossas vitórias.
                                        </p>
                                        <div class="kode-icon"><i class="fa fa-book"></i></div>
                                    </div>
                                    <div class="bb-custom-wrapper">
                                        <div id="bb-bookblock" class="bb-bookblock">
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 1 - AVALIAÇÕES</h3>
                                                    <p>
                                                        Neste capitulo Sun Tzu enfatiza a importância da guerra para uma nação e nos apresenta cinco coisas indispensáveis para prever o desfecho de uma guerra são eles: <br> <br>

                                                        <strong>O caminho:</strong> Seja líder de se mesmo e siga o seu caminho, enfrentando os desafios e medos que só os tornaram mais fortes. <br> <br>

                                                        <strong>O tempo:</strong> Um dos principais desafios dos dias atuais é a “falta de tempo”, otimize seu tempo e o gaste da melhor forma possível, mas esteja atento as mudanças, aos imprevistos, mas o mais importante, estabeleça prioridades. <br> <br>

                                                        <strong>O terreno:</strong> Conheça os lugar onde você está pisando, movimente-se, abra portas. <br> <br>

                                                        <strong>Liderança:</strong> Seja líder de si mesmo. Desenvolva habilidades e qualidades de um líder e as pessoas virão até você. <br> <br>

                                                        <strong>Regras:</strong> Conheça as regras e estará um passo à frente.
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 2 - O COMBATE</h3>
                                                    <p>
                                                        Nesse capitulo ele nos mostra a importância de conhecer as nossas “armas” nossos pontos fortes e fracos, sempre potencializando os fortes e diminuindo o impacto dos fracos,e sempre adquirindo novas habilidades e qualidades. <br> <br>

                                                        Compreenda a guerra pelo qual está lutando, quando mais você conhece, mais perto estará da vitória guerreiros.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 3 - ESTRATÉGIA DE ATAQUE</h3>
                                                    <p>
                                                        Sun Tzu disse: <br> <br>

                                                        <i> “ A habilidade suprema não consiste em ganhar cem batalhas, mas sim vencer o inimigo sem combater.” </i> <br> <br>

                                                        Nesse capitulo ele enfatiza a importância de conhecer a si mesmo e ao inimigo. Não enxergue o inimigo como seu concorrente, ou uma pessoa que queira te derrubar, mas também o reconheça como seus medos, que te impedem de agir. Faça perguntas a si mesmo e perceberá que as repostas serão o conhecimento necessário para enfrenta-los.
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 4 - PREPARAÇÃO</h3>
                                                    <p>
                                                        Sun Tzu disse: <br> <br>

                                                        <i> “Ser invencível significa conhecer a si mesmo, ser vulnerável significa conhecer ao outro” </i> <br> <br>

                                                        Lembre-se: se torne invencível primeiro, conhecendo a si mesmo, a invencibilidade está na defesa e a vulnerabilidade no ataque. Esteja sempre preparado para se defender, mas ataque no momento certo.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 5 - PROPENSÃO</h3>
                                                    <p>
                                                        <i>“Existem apenas cinco notas na escala musical, mas suas combinações são inimagináveis, somente cinco cores básicas, mas nunca vimos todas as suas misturas, há cinco sabores, mas suas variações são ilimitadas.”</i> <br> <br>

                                                        Procure reinventar-se e sempre surpreender-se consigo mesmo e ao próximo. E lute sempre pelo ímpeto isso é propensão.
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 6 - O CHEIO E O VAZIO</h3>
                                                    <p>
                                                        <i> “Para tomar o que se ataca ataque onde não há defesa; para se defender, defenda-se onde o inimigo não parece atacar.” </i> <br> <br>

                                                        Esteja atento, aproveite as oportunidades e adapte-se as circunstâncias.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 7 - MANOBRAS</h3>
                                                    <p>
                                                        Enxergue os problemas como oportunidades disfarçadas, os transformando-os em vantagens. E movimente-se.
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 8 - AS NOVE MUDANÇAS</h3>
                                                    <p>
                                                        Sun Tzu disse: <br> <br>

                                                        <i> “Um general sábio pondera, pesa o que há de favorável, de desfavorável, e decide o que é mais acertado. Ao levar em conta o que é favorável, torna o plano executável, ao levar em conta o que é desfavorável, soluciona as dificuldades.” </i> <br> <br>

                                                        Mas antes de tomar a decisões conheça as regras. Ou as crie.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 9 - SOBRE A MOVIMENTAÇÃO</h3>
                                                    <p>
                                                        Nesse capitulo Sun Tzu traz as formas de como se movimentar na água, na mata, nas colinas e macetes de sinais dados pelo comportamento dos soldados. Como também a importância das ordens, que sejam claras e objetivas resultando-se na obediência. <br> <br>

                                                        <i> “Um exército deve escolher lugares altos, evitar os baixos, valorizar a luz e fugir da sombra.” </i> <br> <br>

                                                        Busque a visão sistêmica das coisas, quanto mais claro for as suas metas e objetivos, mais rápido poderá alcança-los, sendo obediente consigo mesma.
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 10 - O TERRENO</h3>
                                                    <p>
                                                        Sun Tzu nos apresenta neste capitulo alguns tipos de terrenos, que nós também poderemos está pisando em algum deles nesse momento. São classificados como: acessíveis, tortuosos, indecisos, apertados, acidentados ou distantes, e nos traz como se movimentar em cada um deles. <br> <br>

                                                        <i> “Quem conhece a si mesmo e ao inimigo pode garantir a vitória, mas quem conhece o tempo e o terreno alcançara de forma absoluta.” </i>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 11 - OS NOVE TERRITÓRIOS</h3>
                                                    <p>
                                                        Nesse capitulo assim como no anterior, ele nos apresenta os nove territórios e como agir dentro deles. Também enfatiza a velocidade e o ataque surpresa como fator fundamental nessa movimentação. <br> <br>

                                                        Em qual território você se encontra neste momento: Fronteira, chave, disperso, aberto, interseção perigoso, difícil, cercado ou mortal? <br> <br>

                                                        E como está agindo neles?
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 12 - ATAQUE COM FOGO</h3>
                                                    <p>
                                                        Nesse capitulo ele nos mostra as cinco formas de atacar com o fogo. <br> <br>

                                                        Enxergue o fogo como sendo a sua melhor arma ou ferramenta secreta, na qual você tem todo o domínio e use-a de várias maneiras ao seu favor.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bb-item">
                                                <div class="bb-custom-side">
                                                    <h3>CAPÍTULO 13 - O USO DE ESPIÕES</h3>
                                                    <p>
                                                        Nesse capítulos ele vem nos mostra as vantagens de se ter um espião e quais são os tipos de espiões existentes. <br> <br>

                                                        Sun Tzu disse: <br> <br>

                                                        “Somente um soberano sábio e um general habilidoso são capazes de utilizar pessoas inteligentes como espiões e emprega-los, garantindo a realização de grandes feitos.” <br> <br>

                                                        Podemos enxergar esse “espião” como sendo pessoas de confiança na qual juntos iremos realizar grandes feitos, seja ele o sócio com o qual planeja abrir uma empresa, o seu melhor amigo, o seu companheiro de vida. <br> <br>

                                                        Pessoas que tem uma sinergia com você e que juntos possam alcançar grandes conquistas. <br> <br>

                                                        Então pessoal é isso apresento a vocês a “Arte da Guerra” e convido-os- a fazer essa leitura que nos inspira e nos faz pensar de fora da caixa. <br> <br>

                                                        Veja além do que se ver, leia nas entre linhas, pense e reflita. Não é apenas um livro sobre Guerra, mas sim sobre vitória ou que você quiser que ele seja.
                                                    </p>
                                                </div>
                                                <div class="bb-custom-side">
                                                    <h3>CONCLUSÃO</h3>
                                                    <p>
                                                        Esse brilhante livro de apenas treze capítulos e 130 páginas, nos traz ensinamentos e preceitos que ultrapassa os limites do tempo. <br> <br>

                                                        Não pense nele apenas como um livro que fala de Guerra, mas como um livro que fala da importância de vencer na vida. Pois antes de Guerra, vem a palavra a Arte, o que é arte para você? Pra mim a arte é a forma de externalizar os nossos sentimentos. <br> <br>

                                                        Nesse livro Sun Tzu expressa seus sentimentos e compartilha conosco o que aprendeu durante as Guerras que participou. <br> <br>

                                                        Sun Tzu disse: <br> <br>

                                                        <i> “O verdadeiro objetivo da Guerra é a Paz” </i> <br> <br>

                                                        Não estamos vivenciando uma luta armada entre nações, mas estamos constantemente em guerra com nós mesmos, buscando nossas próprias vitorias pessoais e o tão desejado equilíbrio entre a vida pessoal e profissional. Ou seja, estamos em busca da nossa própria Paz.
                                                    </p>
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
