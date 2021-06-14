@extends('site.master.layout')

@section('title', 'Sobre Nós')


@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Sobre Nós"])

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- STORE -->
            <div id="store" class="col-md-12">
                <!-- store products -->
                <div class="row">
                    <p>
                    O Trutaa: É uma plataforma acessível a partir de qualquer dispositivo smart (computador, telemóvel, tablet) que ira conectar os grandes livros académicos e científicos aos estudantes, professores, pessoas com vontade de aprender e amantes da leitura, permitindo a estes leitores terem acesso aos mais variados títulos e referências bibliográficas de grande qualidade e puder pagar de modo parcelado ou na totalidade enquanto aguarda a recepção do livro no endereço a escolha do leitor ou cliente. Dando a possibilidade de tornar as pessoas cada vez mais inteligentes, profissionais realmente capazes em suas áreas de atuação e cada vez mais amantes e consumidores do melhor conhecimento. <br> <br>

                    Aqueles que desejam tornar-se leitores poderão ver todos os livros disponíveis na livraria/biblioteca de forma simples e fácil com auxilio de filtros organizados por categorias e subcategorias(Engenharia, Direito, Economia, Ciências, Medicina, entre outros) ter acesso um pequeno resumo informativo de 5 a 10 linhas que descreve a grande utilidade do titulo ou livro em questão e caso seja do seu interesse poderá deste modo solicitar a encomenda pela modalidade completa ou por parcela.
                    Os leitores podem através da plataforma disponibilizar um endereço para posterior entrega do livro no devido prazo que deve receber a encomenda e deste modo ir acompanhado o estado da sua encomenda.
                    </p>
                </div>
                <!-- /store products -->

               {{-- {!! $servicesAll->links(); !!} --}}
            </div>
            <!-- /STORE -->

            {{-- <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Mais Solicitados</h3>
                    @include('site.master.includes.widget')
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE --> --}}

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection
