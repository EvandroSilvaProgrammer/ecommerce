@extends('site.master.layout')

@section('title', "Finalizar pedido")

@section('content')
@include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Finalizar pedido"])

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                {{-- <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Seu endereço</h3>
                        </div>

                        <div class="form-group">
                            <div class="input-checkbox">
                                <input type="checkbox" id="create-account">
                                <label for="create-account">
                                    <span></span>
                                    Create Account?
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                                    <input class="input" type="password" name="password" placeholder="Enter Your Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Billing Details --> --}}

                    <!-- Shiping Details -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Endereço de entrega</h3>
                        </div>
                        <div class="form-group">
                            <input disabled class="input" type="email" name="email" placeholder=" {{$clientAddress->email}} ">
                        </div>

                        <div class="form-group">
                            <input disabled class="input" type="text" name="province" placeholder=" {{$province->name}} ">
                        </div>

                        <div class="form-group">
                            <input disabled class="input" type="text" name="district" placeholder=" {{$district->name}} ">
                        </div>
                        <div class="form-group">
                            <input disabled class="input" type="text" name="neighborhood" placeholder=" {{$clientAddress->neighborhood}} ">
                        </div>
                        <div class="form-group">
                            <input disabled class="input" type="text" name="street" placeholder=" {{$clientAddress->street}} ">
                        </div>
                        <div class="form-group">
                            <input disabled class="input" type="text" name="house_number" placeholder=" {{$clientAddress->house_number}} ">
                        </div>

                        <form method="POST" action=" {{route('shopCart.toEnd')}} ">
                            {{ csrf_field() }}

                            <!-- Order notes -->
                                <div class="order-notes">
                                    <textarea name="note" class="input" placeholder="Adicionar Nota à Entrega! Caso queira fazer uma observação ou ressalvar algum ponto que julga importante para esta encomenda. (OPCIONAL)"></textarea>
                                </div> <br>
                            <!-- /Order notes -->

                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address" name="address_different">
                                <label for="shiping-address">
                                    <span></span>
                                    Entregar em endereço diferente?
                                </label>
                                <div class="caption">

                                    <div class="form-group">
                                        <select name="province" id="province" class="form-control select2" style="width: 100%;">
                                            <option value="">Província*</option>
                                            @foreach ($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="district" id="district" class="form-control select2" style="width: 100%;">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input class="input" type="text" name="neighborhood" placeholder="Bairro">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="street" placeholder="Rua">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="house_number" placeholder="Número da casa">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->
                    </div>
                    @php $total_pedido = 0; @endphp

                    @foreach ($requests as $request)

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Seu pedido - Refer.: {{$request->id}} </h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>LIVRO</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>

                            @php $productRed = 0; $total_itens = 0; $total_pedido = 0; @endphp

                            @foreach ($request->RequestProduct as $RP)

                            <div class="order-products">
                                @if ($RP->product->qtd === 0 || $RP->qtd > $RP->product->qtd)
                                    @php $productRed = 1; @endphp
                                    <div class="order-col"  style="color: red">
                                        <div><del>{{$RP->qtd}}X  {{ $RP->product->name }} </del></div>
                                        <div><del>AKZ {{ number_format($RP->product->new_price*$RP->qtd, 2, ',', '.') }}</del></div>
                                    </div>
                                @else
                                    <div class="order-col">
                                        <div>{{$RP->qtd}}X  {{ $RP->product->name }}  </div>
                                        <div>AKZ {{ number_format($RP->product->new_price*$RP->qtd, 2, ',', '.') }}</div>
                                    </div>
                                @endif
                            </div>

                            @php
                            if ($RP->product->qtd > 0 && $RP->qtd <= $RP->product->qtd )
                            {
                                $total_produto = $RP->product->new_price*$RP->qtd;
                                $total_itens+=1;
                                $total_pedido += $total_produto;
                            }

                            @endphp
                            @endforeach

                            @endforeach

                            <input type="hidden" name="total_of_request" value="{{$total_pedido}} ">


                            @if ($total_pedido != 0)
                            <div class="order-col">
                                <div>Entrega</div>
                                <div><strong>Grátis</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">{{ number_format($total_pedido, 2, ',', '.') }} </strong></div>
                            </div>
                            @endif

                        </div>

                        @if ($total_pedido != 0)
                            @if ($productRed == 1)
                                <div><strong style="color: red">Observações:</strong></div> <br>

                                <ol>
                                    <li>1ª - Livros sublinhados e com a cor vermelha, representam livros que
                                        infelizmente ficaram com o stock vázio durante a preparação da encomenda
                                        ou as quantidades pedidas já não podem ser fornecidas.  </li> <br>

                                    <li>2ª - Eles não são adicionados ao somatório do valor total a ser pago pela encomenda.</li> <br>

                                    <li>3ª - Eles serão retirados da sua lista de compras assim que concluir a compra.</li> <br>

                                    <li>4ª - Caso queira o livro, mas com menos quantidade vá até o seu
                                        <a style="color: #0A66C2; font-weight: bold" href="{{route('shopCart.index')}}">carrinho de compras</a>
                                        e tente diminuir a quantidade até uma quantidade válida.
                                    </li>

                                </ol>
                            @endif
                        <div class="payment-method">
                            <div><strong>FORMAS DE PAGAMENTO</strong></div> <br>
                            <div class="input-radio">
                                <input type="radio" name="payment_method" value="Transferência bancária" id="payment-1" >
                                <label for="payment-1">
                                    <span></span>
                                    Transferência bancária ou Depósito bancário
                                </label>
                                <div class="caption">
                                    <p>Utilize as seguintes coordenadas bancárias: <br><br>
                                        @foreach ($coordenadas as $coordenada)
                                            <strong>{{ $coordenada->banc }}</strong> {{ $coordenada->iban }}<br><br>
                                        @endforeach
                                    </p><br>
                                </div>
                            </div>
                            {{-- <div class="input-radio">
                                <input type="radio" name="payment_method" value="Multicaixa" id="payment-3"  >
                                <label for="payment-3">
                                    <span></span>
                                    Multicaixa
                                </label>
                                <div class="caption">
                                    <p>No multicaixa vá até a opção PAGAMENTOS -> SERVIÇOS -> Trutaa -> </p>
                                </div>
                            </div> --}}

                            {{--
                            <div class="input-radio">
                                <input type="radio" name="payment_method" value="Acto da entrega" id="payment-2"  >
                                <label for="payment-2">
                                    <span></span>
                                    No acto da entrega
                                </label>
                                <div class="caption">
                                    <p>No acto da entrega nosso estafeta estará equipado com um TPA para assim poder efectuar o pagamento da encomenda
                                        ou poderá efectuar o pagamento em Cash (Até 100.000 Akz) </p>
                                </div>
                            </div>
                            --}}
                        </div>
                        <div class="input-checkbox">
                            <input name="terms" type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                Eu li e aceito os <a data-toggle="modal" data-target="#modal-terms"><strong >Termos & Condições</strong></a>
                            </label>
                        </div>

                        <input type="hidden" name="request_id" value="{{$request->id}}">

                        <button id="concluir-compra" style="display: none" type="submit" class="primary-btn order-submit">Concluir compra</button>
                        @else
                            <div style="color: red; text-align: justify"><strong>Lamentamos, mas infelizmente todos os
                                 livros selecionados ficaram sem stock durante a preparação da encomenda
                                ou as quantidades pedidas já não podem ser fornecidas.</strong></div>
                        @endif

                        @include('site.shopcart.includes.modalTerms')

                    </form>


                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    @endsection


    @push('checkoutStyle')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admim/bower_components/select2/dist/css/select2.min.css')}}">
    @endpush

    @push('checkoutScript')
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


