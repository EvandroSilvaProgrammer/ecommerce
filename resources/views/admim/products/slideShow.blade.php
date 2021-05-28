@extends('admim.master.layout')

@section('title', 'Gestão do slide show')
@section('pageHeader', 'Gestão do slide show')


@section('content')
<?php $plugin=0; ?>
<!-- Main content -->
<section class="content container-fluid">
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Adicionar produtos do slide</h3>
        </div>
        <!-- /.box-header -->
        <form action="{{route('admim.product.slideShowOn')}}" method="POST">
            @csrf

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th width="10" >Selecionar</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($productsOff as $productOff)
                        
                        <tr>
                            <td> <label style="font-weight: 500; cursor: pointer;" for="item-{{$productOff->id}}">{{$productOff->name}}</label> </td>
                            <td style="text-align: center;"> <input type="checkbox" id="item-{{$productOff->id}}" name="id[]" value=" {{$productOff->id}} "> </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Produto</th>
                            <th width="10" >Selecionar</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
            <button style="margin-left: 1%; margin-bottom: 1%" type="submit" class="btn btn-success" >Adicionar</button>   
        </form>
    </div>
    <!-- /.box -->
    
    
    @can('Cadastrar Produtos')
    <section class="content">
            <div class="col-md-12"> 
                <!-- DIRECT CHAT SUCCESS -->
                <div class="box box-success direct-chat direct-chat-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Retirar produtos do slide</h3>
                        
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                            </div>
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <form action="{{route('admim.product.slideShowOff')}}" method="POST">
                                    @csrf
                                    @foreach ($productsOn as $productOn)
                                    <input type="checkbox" id="item-{{$productOn->id}}" name="id[]" value=" {{$productOn->id}} ">
                                    
                                    <label for="item-{{$productOn->id}}">{{$productOn->name}}</label> <br> <br>
                                    @endforeach
                                </div>
                                <!--/.direct-chat-messages-->
                                <button style="margin-left: 2%; margin-bottom: 5%" type="submit" class="btn btn-success btn-flat">Retirar</button>
                                
                            </form>
                            
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!--/.direct-chat -->
                </div>
                <!-- /.col -->
                
            </section>
            @endcan
            
            
            
        </section>
        <!-- /.content --> 
        @endsection
        
        
