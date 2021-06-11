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
                    <p>A Doriema, Lda é uma empresa de direito angolano, constituída em 2013, integradora de soluções globais nas áreas de
                        telecomunicações, informática, materiais de escritório e prestação de serviços, adaptadas às necessidades reais de cada cliente.
                        Actuamos na Província do Namibe, estando essencialmente direccionados para o mercado de PME’s, Organismos do Estado e
                        Particulares. <br><br>
                        Acreditamos que podemos marcar a diferença e que as nossas soluções constituem uma vantagem competitiva para os nossos
                        Clientes, sendo o nosso compromisso colocar à sua disposição produtos fiáveis e de qualidade. <br><br>
                        Por esse mesmo motivo, apostamos em parcerias com os melhores fabricantes nas áreas em que actuamos, no
                        recrutamento e na formação constante dos nossos colaboradores.
                        Os nossos clientes podem ainda contar com um acompanhamento personalizado por parte de colaboradores experientes, o que lhes
                        permite usufruir de serviços de excelência. <br><br>
                        Estamos permanentemente atentos aos novos desafios a que os nossos Clientes estão sujeitos para conseguir corresponder às novas
                        abordagens de mercado. Procuramos criar relações de confiança e a longo prazo com os nossos Clientes porque o futuro é um lugar
                        importante para nós. <br><br>
                        Pretendemos desta forma ser um parceiro estratégico para os nossos clientes, intervindo em sectores exigentes e respondendo com
                        eficácia e eficiência aos desafios colocados.</p>

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
