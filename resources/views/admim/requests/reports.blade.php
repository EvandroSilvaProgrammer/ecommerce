@extends('admim.master.layout')

@section('title', 'Relatórios dos Pedidos')
@section('pageHeader', 'Relatórios dos Pedidos')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">

    @can('Gerar Relatórios')
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3 id="only-visitors">{{$totalGeneralRequests}}</h3>
                <p>Todos os pedidos</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('admim.Reportsrequest.allRequestsExcel')}}" class="small-box-footer">Gerar Relatório Excel <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{route('admim.Reportsrequest.allRequestsPDF')}}" class="small-box-footer">Gerar Relatório PDF <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="only-visitors">{{$orderedRequests}}</h3>
                <p>Pedidos Encomendados</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('admim.Reportsrequest.orderedRequestsExcel')}}" class="small-box-footer">Gerar Relatório Excel <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{route('admim.Reportsrequest.orderedRequestsPDF')}}" class="small-box-footer">Gerar Relatório PDF <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="only-visitors">{{$deliveryRequests}}</h3>
                <p>Pedidos Entregues</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('admim.Reportsrequest.deliveryRequestsExcel')}}" class="small-box-footer">Gerar Relatório Excel <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{route('admim.Reportsrequest.deliveryRequestsPDF')}}" class="small-box-footer">Gerar Relatório PDF <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="only-visitors">{{$canceledRequests}}</h3>
                <p>Pedidos Cancelados</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('admim.Reportsrequest.canceledRequestsExcel')}}" class="small-box-footer">Gerar Relatório Excel <i class="fa fa-arrow-circle-right"></i></a>
            <a href="{{route('admim.Reportsrequest.canceledRequestsPDF')}}" class="small-box-footer">Gerar Relatório PDF <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->


    <!-- /.col (left) -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Busca por datas</h3>
            </div>
            <div class="box-body">

                <form action="{{route('admim.Reportsrequest.personalizedRequests')}}" method="POST">
                    @csrf
                    <!-- Date -->
                    <div class="form-group">
                        <label>Data 1:</label>
                        <div style="width: 100%;" class="input-group date">
                            <input class="form-control pull-right" type="date" name="date1">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Date -->
                    <div class="form-group">
                        <label>Data 2:</label>
                        <div style="width: 100%;" class="input-group date">
                            <input  class="form-control pull-right" type="date" name="date2">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Categoria da busca</label> <br>
                        <select name="status" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="all">Todos pedidos</option>
                            <option value="EC">Pedidos encomendados</option>
                            <option value="EN">Pedidos entregues</option>
                            <option value="CA">Pedidos cancelados</option>
                        </select>
                    </div>
                    <!-- /.form-group -->

                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Formato do relatório</label> <br>
                        <select name="ReportFormat" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Excel</option>
                            <option>PDF</option>
                        </select>
                    </div> <br>
                    <!-- /.form-group -->

                    <button type="submit" class="btn btn-block btn-success btn-lg"> <i class="fa fa-download"></i> Gerar Relatório</button>
                </form>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    @endcan


</section>
<!-- /.content -->
@endsection
