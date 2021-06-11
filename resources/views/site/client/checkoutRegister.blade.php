<div class="modal modal-success fade" id="modal-client-checkout-register">
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
                                        <h3 style="text-align: center" class="box-title">Criar uma conta Doriema! Mais fácil seria difícil.</h3>
                                    </div> <br>
                                    <!-- /.box-header -->

                                    <p class="login-box-msg">
                                        @if ( Session::has('nameError') )
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('nameError') }}
                                            </div> 

                                            <script>
                                                window.onload = function teste(){
                                                    $('#modal-client-checkout-register').modal('show')
                                                };
                                            </script>
                                            
                                        @elseif ( Session::has('emailError') )
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('emailError') }}
                                            </div> 

                                            <script>
                                                window.onload = function teste(){
                                                    $('#modal-client-checkout-register').modal('show')
                                                };
                                            </script>

                                        @elseif ( Session::has('emailError2') )
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('emailError2') }}
                                            </div> 

                                            <script>
                                                window.onload = function teste(){
                                                    $('#modal-client-checkout-register').modal('show')
                                                };
                                            </script>

                                        @elseif ( Session::has('passwordError') )
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('passwordError') }}
                                            </div> 

                                            <script>
                                                window.onload = function teste(){
                                                    $('#modal-client-checkout-register').modal('show')
                                                };
                                            </script>
                                        
                                        @elseif ( Session::has('passwordsError') )
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('passwordsError') }}
                                            </div> 

                                            <script>
                                                window.onload = function teste(){
                                                    $('#modal-client-checkout-register').modal('show')
                                                };
                                            </script>

                                        @else
                                            Preencha os campos abaixo para criar sua conta.
                                        @endif
                                    </p>
                                    <!-- form start -->
                                    <form action="{{route('shopCart.checkoutPOST')}}" method="POST" id="loginForm">
                                        @csrf
                                        <div class="row">

                                            <input type="hidden" name="register" value="1">

                                            <div class="form-group col-lg-12">
                                                <label>Nome</label><i style="color: red;">*</i>
                                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label>Email</label><i style="color: red;">*</i>
                                                <input name="email" type="email" class="form-control" value="{{old('email')}}" >
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Senha</label><i style="color: red;">*</i>
                                                <input id="password4" name="password" type="password" class="form-control">
                                                <p id="capslock4" style="margin-left:2px; color:red; padding-top:4px; display:none; ">CapsLock activo</p>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Repetir senha</label><i style="color: red;">*</i>
                                                <input id="password5" name="confirm_password" type="password" class="form-control">
                                                <p id="capslock5" style="margin-left:2px; color:red; padding-top:4px; display:none; ">CapsLock activo</p>
                                            </div>
                                        </div> <br> <br>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-block btn-flat">Criar conta</button>
                                        </div>
                                    </form>
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
        var password4 = document.getElementById('password4');
        var capsLock4 = document.getElementById('capslock4');

        password4.addEventListener("keyup", function(event){
            if(event.getModifierState('CapsLock'))
            {
                capsLock4.style.display = "block";
            }
            else
            {
                capsLock4.style.display = "none";
            }
        });

        var password5 = document.getElementById('password5');
        var capsLock5 = document.getElementById('capslock5');

        password5.addEventListener("keyup", function(event){
            if(event.getModifierState('CapsLock'))
            {
                capsLock5.style.display = "block";
            }
            else
            {
                capsLock5.style.display = "none";
            }
        });

    </script>
@endpush
