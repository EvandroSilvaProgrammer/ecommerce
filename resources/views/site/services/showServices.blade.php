@extends('site.master.layout')

@section('title', 'Serviços')


@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Serviços"])

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
                    @foreach ($servicesAll as $serviceAll)
                    <!-- product -->
                    <div class="col-md-4 col-xs-6">
                        @include('site.services.includes.servicesSection')
                    </div>
                    <!-- /product -->
                    @endforeach
                </div>
                <!-- /store products -->

                {!! $servicesAll->links(); !!}
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
