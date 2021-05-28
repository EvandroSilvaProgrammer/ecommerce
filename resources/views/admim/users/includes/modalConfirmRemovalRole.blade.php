<div class="modal modal-danger fade" id="modal-danger-role">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{$role->name}}</h4>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja exluir esta função?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                        <a href="{{route('admim.roles.destroy', $role->id)}}"><button type="button" class="btn btn-outline">Excluir</button></a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

