<div class="modal modal-success fade" id="modal-exchange">
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
                                        <h3 class="box-title">Actualizar Taxa de Câmbio</h3>
                                    </div>
                                    <!-- /.box-header -->

                                    <!-- form start -->
                                    <form action="{{route('admim.exchange.update')}}" method="POST" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label class="exampleInputFile" for="exampleInputEmail1">Nova taxa</label>
                                                <input name="exchange" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nova taxa de câmbio" value="">
                                            </div>

                                        </div>
                                        <!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
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

