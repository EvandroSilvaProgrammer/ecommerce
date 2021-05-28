<div class="modal modal-success fade" id="modal-permissions">
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
                                            <h3 class="box-title">Adicionar permissão a função {{$role->name}}</h3>
                                        </div>
                                        <!-- /.box-header -->

                                        <!-- form start -->
                                        <form action="{{route('admim.permissionRole.store')}}" method="POST" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="box-body">
                                                <input type="hidden" name="role_id" value="{{$role->id}}">

                                                <div class="form-group">
                                                    <label class="exampleInputFile" for="exampleInputEmail1">Permissões</label>
                                                    <select name="permission_id" class="form-control select2" style="width: 100%;">
                                                        @foreach ($allPermissions as $allPermission)
                                                            <option value="{{$allPermission->id}}">{{$allPermission->name}}</option>
                                                        @endforeach
                                                    </select>
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

