@extends('site.master.layout')

@section('title', 'Registro cliente')


@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Estimado(a) clinte precisa concluir o registro do seu perfil para finalizar a compra. "])

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
                                        <form action="{{route('client.updateRegister')}}" method="POST" id="loginForm">
                                            @csrf
                                            <div class="row">
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Telefone 1 </label><i style="color: red;">*</i>
                                                    <input name="telephone" type="text" class="form-control" value="{{old('telephone')}}" >
                                                </div>
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Telefone 2</label>
                                                    <input name="telephone2" type="text" class="form-control" value="{{old('telephone2')}}" >
                                                </div>
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Província</label><i style="color: red;">*</i>
                                                    <select name="province" id="province" class="form-control select2" style="width: 100%;">
                                                        <option value="">Selecione uma Província</option>
                                                        @foreach ($provinces as $province)
                                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Município</label><i style="color: red;">*</i>
                                                    <select name="district" id="district" class="form-control select2" style="width: 100%;">
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Bairro</label><i style="color: red;">*</i>
                                                    <input name="neighborhood" class="form-control" value="{{old('neighborhood')}}">
                                                </div>
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Rua</label><i style="color: red;">*</i>
                                                    <input name="street" type="text" class="form-control" value="{{old('street')}}" >
                                                </div>
                                                
                                                <div class="form-group col-lg-12">
                                                    <label>Número casa</label>
                                                    <input name="house_number" type="number" class="form-control" value="{{old('house_number')}}">
                                                </div>
                                                
                                            </div>
                                            <div class="text-center">
                                                <button style="padding-left: 40px; padding-right: 40px;" type="submit" class="btn btn-success loginbtn">FINALIZAR</button>
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
    </script>
@endpush