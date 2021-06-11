<!-- Modal -->
<div class="modal fade" id="modal-msgs" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Aviso do sistema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (Session::has('mensagem-sucesso'))

                <div class="mensagem-sucesso">
                    <strong>{{ Session::get('mensagem-sucesso') }}</strong>
                </div>

                <script>
                    window.onload = function teste(){
                        $('#modal-msgs').modal('show')
                    };
                </script>
                @endif

                @if (Session::has('mensagem-falha'))

                    <div class="mensagem-falha">
                        <strong>{{ Session::get('mensagem-falha') }}</strong>
                    </div>

                    <script>
                        window.onload = function teste(){
                            $('#modal-msgs').modal('show')
                        };
                    </script>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
