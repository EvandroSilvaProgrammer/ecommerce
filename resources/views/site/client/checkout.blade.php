<div class="modal modal-success fade" id="modal-client-checkout">
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
                                        <h3 style="text-align: center" class="box-title">Precisa iniciar sessão para finalizar sua compra.</h3>
                                    </div> <br>
                                    <!-- /.box-header -->

                                    <p class="login-box-msg">
                                        @if ( Session::has('checkoutError') )
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('checkoutError') }}
                                            </div>

                                            <script>
                                                window.onload = function checkout(){
                                                    $('#modal-client-checkout').modal('show')
                                                };
                                            </script>
                                        @else
                                            Coloque seus dados para iniciar sessão
                                        @endif
                                    </p>
                                    <!-- form start -->
                                    <form action="{{route('shopCart.checkoutPOST')}}" method="POST">
                                        @csrf

                                      <div class="form-group has-feedback">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                      </div>

                                      <div class="form-group has-feedback">
                                        <input type="password" id="password3" name="password" class="form-control" placeholder="Password">
                                        <p id="capslock3" style="margin-left:2px; color:red; padding-top:4px; display: none;">CapsLock activo</p>
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                      </div>

                                      <div class="row">
                                        <!-- /.col -->
                                        <div class="col-xs-4">
                                          <button type="submit" class="btn btn-success btn-block btn-flat">Entrar</button>
                                        </div> <br>
                                        <!-- /.col -->
                                      </div>
                                    </form>

                                    <!-- /.col -->
                                    <br> <br>
                                    <a href="#" data-toggle="modal" data-target="#modal-client-checkout-register" data-dismiss="modal">
                                    <div class="col-12">
                                        <button class="btn btn-success btn-block btn-flat">Não tem uma conta? Clique aqui.</button>
                                    </div>
                                    </a>
                                      <!-- /.col -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    </section>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                </div> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@push('loginScript')
    <script>
        var password3 = document.getElementById('password3');
        var capsLock3 = document.getElementById('capslock3');

        password3.addEventListener("keyup", function(event){
            if(event.getModifierState('CapsLock'))
            {
                capsLock3.style.display = "block";
            }
            else
            {
                capsLock3.style.display = "none";
            }
        });
    </script>
@endpush
