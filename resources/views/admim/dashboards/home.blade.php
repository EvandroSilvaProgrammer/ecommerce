{{-- <link rel="stylesheet" href="{{ asset('admim/dashboards/css/bootstrap.min.css') }}"> --}}


@extends('admim.master.layout')

@section('title', 'Dashboards')
@section('pageHeader', 'Visitas dssd')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    {{-- @can('Visualizar Dashboards') --}}
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner" >
                        <h3 id="general-visits"> </h3>
                        <p>Total geral de visitas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" id="gvRefresh" class="small-box-footer">Actualizar <i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="only-visitors">  </h3>
                        <p>Visitantes únicos hoje</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" id="ovRefresh" class="small-box-footer">Actualizar <i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="users-register"></h3>

                        <p>Total de usuários cadastrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" id="ucRefresh" class="small-box-footer">Actualizar <i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="general-only-visitors"></h3>

                        <p>Total de Visitantes Únicos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" id="tovRefresh" class="small-box-footer">Actualizar <i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->


        <div class="row  mt-3">
            <div class="col-md-9">
                <div class="row">
                    {{-- Visitas --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mt-2">Visitas</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link visits active" data-toggle="pill" id="visits_today" href="#"
                                                role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link visits " data-toggle="pill" id="visits_month" href="#"
                                                role="tab" aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link visits" data-toggle="pill" id="visits_year" href="#"
                                                role="tab" aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="visits" height="72"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- /Visitas --}}
                </div>

                <div class="row mt-3">
                    {{-- Navegador --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mt-2">Navegador</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link browser active" data-toggle="pill" id="browser_today"
                                                href="#" role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link browser" data-toggle="pill" id="browser_month" href="#"
                                                role="tab" aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link browser" data-toggle="pill" id="browser_year" href="#"
                                                role="tab" aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="browser"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- /Navegador --}}

                    {{-- Plataforma --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mt-2">Dispositivos</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link device active" data-toggle="pill" id="device_today"
                                                href="#" role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link device" data-toggle="pill" id="device_month" href="#"
                                                role="tab" aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link device" data-toggle="pill" id="device_year" href="#"
                                                role="tab" aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="device"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- Plataforma --}}
                </div>
            </div>

            {{-- Listas --}}
            <div class="col-md-3">
                {{-- URI --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="mt-2">Páginas</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list active" data-toggle="pill" id="uri_today" href="#"
                                                role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="uri_month" href="#" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="uri_year" href="#" role="tab"
                                                aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-striped" id="table_uri"></table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /URI --}}

                {{-- referer --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="mt-2">Redirect</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list active" data-toggle="pill" id="referer_today" href="#"
                                                role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="referer_month" href="#" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="referer_year" href="#" role="tab"
                                                aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-striped" id="table_referer"></table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /refer --}}


                {{-- Região --}}
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="mt-2">Regiões</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list active" data-toggle="pill" id="region_today" href="#"
                                                role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="region_month" href="#"
                                                role="tab" aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="region_year" href="#" role="tab"
                                                aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-striped" id="table_region"></table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /Região --}}

                {{-- País --}}
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="mt-2">Países</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list active" data-toggle="pill" id="country_today" href="#"
                                                role="tab" aria-controls="pills-home" aria-selected="true">Hoje</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="country_month" href="#"
                                                role="tab" aria-controls="pills-profile" aria-selected="false">Mês</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list" data-toggle="pill" id="country_year" href="#"
                                                role="tab" aria-controls="pills-contact" aria-selected="false">Ano</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-striped" id="table_country"></table>
                            </div>
                            {{-- /País --}}
                        </div>
                    </div>
                </div>
                {{-- /País --}}
            </div>
            {{-- /Listas --}}
        </div>
    </section>
    {{--  @endcan --}}

</section>
<!-- /.content -->
@endsection

@push('stylesDashboard')
    {{-- <link rel="stylesheet" href="{{ asset('admim/dashboards/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admim/dashboards/css/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admim/dashboards/css/skebug.css') }}">
@endpush

@push('scriptsDashboard')
    <script src="{{ asset('admim/dashboards/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admim/dashboards/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('admim/dashboards/js/Chart.min.js') }}"></script>
    <script src="{{ asset('admim/dashboards/js/dashboard.js') }}"></script>
@endpush
