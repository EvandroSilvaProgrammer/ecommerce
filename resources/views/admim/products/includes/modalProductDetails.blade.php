<div class="modal modal-success fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Adicionar Detalhes para {{$product->name}}</h3>
                                    </div>
                                    <!-- /.box-header -->

                                    <!-- form start -->
                                    <form action="{{route('admim.products.addDetail.store', $product->id)}}" method="POST" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <div class="box-body">
                                            <input type="hidden" name="product" value="{{$product->id}}">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1" style="color: black">Nome</label>
                                                <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do Detalhe" value="{{old('name')}}">
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1" style="color: black">Informação</label>
                                                <input name="info" type="text" class="form-control" id="exampleInputEmail1" placeholder="Informação do Detalhe" value="{{old('name')}}">
                                            </div>


                                        </div>
                                        <!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-success">Adicionar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

