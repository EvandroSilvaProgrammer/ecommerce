@extends('site.master.layout')

@section('title', 'Perfil do cliente')


@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Perfil do cliente ({$client->name}) "])

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            
            <!-- STORE -->
            <div id="store" class="container col-md-6 col-md-offset-3">
                <!-- store products -->
                    <div class="error-pagewrap">
                        <div class="error-page-int">
                        
                            <div class="content-error">
                                <div class="hpanel">
                                    <div class="panel-body">
                                        <p class="login-box-msg">
                                            @if ($errors->all())
                                            @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger" role="alert">
                                                {{$error}}
                                            </div>
                                            @endforeach
                                            
                                            @endif
                                        </p>
                                        <form action="{{route('client.profile.update')}}" method="POST" id="loginForm">
                                            @method('PUT')
                                            @csrf
                                            <div class="row">

                                                <div class="form-group ">
                                                    <label>Nome </label><i style="color: red;">*</i>
                                                    <input name="name" type="text" class="form-control" value="{{$client->name}}" >
                                                </div>

                                                <div class="form-group ">
                                                    <label>Email </label><i style="color: red;">*</i>
                                                    <input name="email" type="email" class="form-control" value="{{$client->email}}" >
                                                </div>

                                                <div class="form-group">
                                                    <label>Telefone 1 </label><i style="color: red;">*</i>
                                                    <input name="telephone" type="text" class="form-control" value=" {{$client->telephone}}" >
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Telefone 2</label>
                                                    <input name="telephone2" type="text" class="form-control" value=" @if(isset($telephone2->telephone)) {{$telephone2->telephone}} @endif  " >
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Província</label><i style="color: red;">*</i>
                                                    <select name="province" id="province" class="form-control select2" style="width: 100%;">
                                                        @foreach ($provinces as $province)
                                                            @if ($province->id === $client->province)
                                                                <option selected value="{{$province->id}}">{{$province->name}}</option>
                                                            @else
                                                                <option value="{{$province->id}}">{{$province->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Município</label><i style="color: red;">*</i>
                                                    <select name="district" id="district" class="form-control select2" style="width: 100%;">
                                                        @foreach ($districts as $district)
                                                            @if ($district->id === $client->district)
                                                                <option selected value=" {{$district->id}} "> {{$district->name}} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Bairro</label><i style="color: red;">*</i>
                                                    <input name="neighborhood" class="form-control" value="{{$client->neighborhood}}">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Rua</label><i style="color: red;">*</i>
                                                    <input name="street" type="text" class="form-control" value="{{$client->street}}" >
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Número casa</label>
                                                    <input name="house_number" type="number" class="form-control" value="{{$client->house_number}}">
                                                </div>

                                                <div class="input-checkbox">
                                                    <label for="shiping-address"> Actualizar senha? Clique aqui!</label>
                                                    <input type="checkbox" id="shiping-address" name="address_different"> <br> <br>

                                                    <div class="caption">

                                                        <div class="form-group">
                                                            <label style="margin-left: -3%; font-weight: bold">Senha</label><i style="color: red;">*</i>
                                                            <input id="password100" name="password" type="password" class="form-control" placeholder="Digite a sua senha actual" >
                                                            <p id="capslock100" style="margin-left:2px; color:red; padding-top:4px; display:none; ">CapsLock activo</p>
                                                        </div>
                    
                                                        <div class="form-group col-lg-6">
                                                            <label style="margin-left: -6%; font-weight: bold">Nova senha</label><i style="color: red;">*</i>
                                                            <input id="password101" name="new_password" type="password" class="form-control" placeholder="Digite a nova senha" >
                                                            <p id="capslock101" style="margin-left:2px; color:red; padding-top:4px; display:none; ">CapsLock activo</p>
                                                        </div>
            
                                                        <div class="form-group col-lg-6">
                                                            <label style="margin-left: -6%; font-weight: bold">Rpetir nova senha</label><i style="color: red;">*</i>
                                                            <input id="password102" name="confirm_password" type="password" class="form-control" placeholder="Confirme a nova senha" >
                                                            <p id="capslock102" style="margin-left:2px; color:red; padding-top:4px; display:none; ">CapsLock activo</p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="text-center">
                                                <button style="padding-left: 40px; padding-right: 40px;" type="submit" class="btn btn-success loginbtn">ACTUALIZAR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <!-- /store products -->
                
                
            </div>
            <!-- /STORE -->
            
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection

@push('clientRegister_Styles')

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admim/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admim/bower_components/Ionicons/css/ionicons.min.css')}}">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admim/plugins/iCheck/square/blue.css')}}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admim/bower_components/select2/dist/css/select2.min.css')}}">
@endpush

@push('clientRegister_Script')
    <script src="{{asset('site/js/jquery.min.js')}}"></script>
    <script src="{{asset('site/js/province_district.js')}}"></script>

    <!-- Select2 -->
    <script src="{{asset('admim/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        var password100 = document.getElementById('password100');
        var capsLock100 = document.getElementById('capslock100');

        password100.addEventListener("keyup", function(event){
            if(event.getModifierState('CapsLock'))
            {
                capsLock100.style.display = "block";
            }
            else
            {
                capsLock100.style.display = "none";
            }
        });

        var password101 = document.getElementById('password101');
        var capsLock101 = document.getElementById('capslock101');

        password101.addEventListener("keyup", function(event){
            if(event.getModifierState('CapsLock'))
            {
                capsLock101.style.display = "block";
            }
            else
            {
                capsLock101.style.display = "none";
            }
        });

        var password102 = document.getElementById('password102');
        var capsLock102 = document.getElementById('capslock102');

        password102.addEventListener("keyup", function(event){
            if(event.getModifierState('CapsLock'))
            {
                capsLock102.style.display = "block";
            }
            else
            {
                capsLock102.style.display = "none";
            }
        });


        
    </script>
@endpush