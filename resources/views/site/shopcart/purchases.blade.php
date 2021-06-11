@extends('site.master.layout')

@section('title', 'Lista de compras')

@section('content')
    @include('site.master.includes.breadcrumb', ['titleBreadcrumb' => "Lista de Compras"])
    @php $showLinks1 = 1; @endphp
    @php $showLinks2 = 1; @endphp

    <div class="container py">

    <!-- Cart -->
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Compras em andamento</div>

                        @forelse($purchases as $request)

                            <!-- Cabeçalho -->
                            <div class="request-header">
                                <div class="request-id">Pedido Refer.: {{$request->id}}</div>
                                @if ($request->status == 'EC')
                                    <div class="request-status">Status: Aguardando pagamento</div>
                                @endif
                                <div class="request-date">Criado em: {{ $request->created_at->format('d/M/Y') }} {{$request->time}} </div>
                                <div class="request-date" style="color: #0A66C2">
                                    Tem até: {{$request->created_at->format('d') + 2}}/{{$request->created_at->format('M')}}/{{$request->created_at->format('Y')}} {{$request->time}}
                                    para efectuar o pagamento
                                </div>
                            </div>

                            @php
                                $date1 = strtotime( $request->updated_at );
                                $date2 = strtotime(date('Y/m/d H:i'));

                                $intervalo = abs( $date2 - $date1 ) / 60;
                            @endphp

                            <form method="POST" action=" {{route('shopCart.cancel')}} ">
                                {{ csrf_field() }}
                                <input type="hidden" name="request_id" value="{{$request->id}}">
                                <div class="cart_items">
                                    <ul class="cart_list">
                                        @php $total_itens = 0; $total_pedido = 0; @endphp

                                        @foreach ($request->RequestProduct as $RP)
                                            <li class="cart_item clearfix">
                                                @if ($intervalo < 360)
                                                    <div  title="Remover livro">
                                                        @if ($RP->status == 'EC')
                                                            <input type="checkbox" id="item-{{$RP->id}}" name="id[]" value=" {{$RP->id}} ">

                                                            <label for="item-{{$RP->id}}">Selecionar</label>
                                                        @else
                                                            <p style="color: red">CANCELADO</p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div  title="Remover livro">
                                                        @if ($RP->status == 'CA')
                                                            <p style="color: red">CANCELADO</p>
                                                        @endif
                                                    </div>
                                                @endif

                                                <div class="cart_item_image">
                                                    <a href="{{route('product.show', $RP->product->id)}}">
                                                        <img src="{{url("storage/{$RP->product->image}")}}" alt="{{ $RP->product->name }}">
                                                    </a>
                                                </div>

                                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                    <div class="cart_item_name cart_info_col">
                                                        <div class="cart_item_title">Livro</div>
                                                        <a href="{{route('product.show', $RP->product->id)}}">
                                                            <div class="cart_item_text">{{ $RP->product->name }} </div>
                                                        </a>
                                                    </div>

                                                    {{-- <div style="display: none" class="cart_item_color cart_info_col">
                                                        <div class="cart_item_title">Cor</div>
                                                        <div class="cart_item_text">{{$RP->color}}</div>
                                                    </div> --}}

                                                    <div class="cart_item_quantity cart_info_col">
                                                        <div class="cart_item_title">Quantidade</div>
                                                        <div class="cart_item_text">{{$RP->qtd}}</div>
                                                    </div>

                                                    <div class="cart_item_price cart_info_col">
                                                        <div class="cart_item_title">Preço</div>
                                                        <div class="cart_item_text">AKZ {{ number_format($RP->product->new_price, 2, ',', '.') }}</div>
                                                    </div>

                                                    @php
                                                        $total_produto = $RP->product->new_price * $RP->qtd;
                                                        $total_itens+=1;
                                                        if ($RP->status == 'EC') {
                                                            $total_pedido += $total_produto;
                                                        }
                                                    @endphp

                                                    <input type="hidden" value="{{$total_pedido}}" name="total_pedido">

                                                    <div class="cart_item_total cart_info_col">
                                                        <div class="cart_item_title">Total</div>
                                                        <div class="cart_item_text">AKZ {{ number_format($total_produto, 2, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Order Total -->
                                <div class="request-header" style="margin-top: 1.5%; margin-bottom: 5%;">
                                    <div class="request-id" >Sub Total:  {{ number_format($total_pedido, 2, ',', '.') }} AKZ</div>
                                </div>

                                @if ($intervalo < 360)
                                    <div class="cart_buttons">
                                        <button style="margin-top: -2%" type="submit" class="button cart_button_clear">Cancelar</button> <br> <br> <br> <br> <br>
                                    </div>
                                @endif
                            </form>
                        @empty
                            @php $showLinks1 = 0; @endphp
                            <div>
                                @if ($canceled->count() > 0)
                                <div class="callout callout-info">
                                    <h4>Neste momento não há nenhuma compra em andamento</h4>
                                </div>
                                @else
                                <div class="callout callout-info">
                                    <h4>Ainda não efectivaste nenhuma compra</h4>
                                </div>
                                @endif
                            </div>
                        @endforelse

                        @if ($showLinks1 == 1)
                            {!! $purchases->links() !!}
                        @endif

                        <div class="cart_title">Compras concluídas</div>
                        @forelse($canceled as $request)
                            <!-- Cabeçalho -->
                            <div class="request-header">
                                <div class="request-id">Pedido Refer.: {{$request->id}}</div>
                                @if ($request->status == 'EN')
                                    <div class="request-id">Status: Entregue!</div>
                                    <div class="request-date">Entregue em: {{ $request->updated_at->format('d/m/Y H:i') }} </div>
                                @endif
                                @if ($request->status == 'PA')
                                    <div class="request-id">Status: Pago!</div>
                                    <div class="request-date">Pagamento confirmado em: {{ $request->updated_at->format('d/m/Y H:i') }} </div>
                                @endif
                            </div>

                            <div class="cart_items">
                                <ul class="cart_list">

                                    @php $total_itens = 0; $total_pedido = 0; @endphp

                                    @foreach ($request->RequestProduct as $RP)
                                        @if ($RP->status == 'PA' || $RP->status == 'EN')
                                            <li class="cart_item clearfix">
                                                <div class="cart_item_image">
                                                    <a href="{{route('product.show', $RP->product->id)}}">
                                                        <img src="{{url("storage/{$RP->product->image}")}}" alt="{{ $RP->product->name }}">
                                                    </a>
                                                </div>
                                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                    <div class="cart_item_name cart_info_col">
                                                        <div class="cart_item_title">Livro</div>
                                                        <a href="{{route('product.show', $RP->product->id)}}">
                                                            <div class="cart_item_text">{{ $RP->product->name }}</div>
                                                        </a>
                                                    </div>

                                                    {{-- <div class="cart_item_color cart_info_col">
                                                        <div class="cart_item_title">Cor</div>
                                                        <div class="cart_item_text">{{$RP->color}}</div>
                                                    </div> --}}

                                                    <div class="cart_item_quantity cart_info_col">
                                                        <div class="cart_item_title">Quantidade</div>
                                                        <div class="cart_item_text">{{$RP->qtd}}</div>
                                                    </div>

                                                    <div class="cart_item_price cart_info_col">
                                                        <div class="cart_item_title">Preço</div>
                                                        <div class="cart_item_text">AKZ {{ number_format($RP->product->new_price, 2, ',', '.') }}</div>
                                                    </div>

                                                    @php
                                                    $total_produto = $RP->product->new_price * $RP->qtd;
                                                    $total_itens+=1;
                                                    $total_pedido += $total_produto;
                                                    @endphp

                                                    <div class="cart_item_total cart_info_col">
                                                        <div class="cart_item_title">Total</div>
                                                        <div class="cart_item_text">AKZ {{ number_format($total_produto, 2, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Order Total -->
                            <div class="request-header" style="margin-top: 1.5%; margin-bottom: 5%; ">
                                <div class="request-id">Sub total: {{ number_format($total_pedido, 2, ',', '.') }} AKZ </div>
                            </div>

                        @empty
                            @php $showLinks2 = 0; @endphp
                            <div class="callout callout-info">
                                <h4>Nenhuma compra concluída</h4>
                            </div>
                        @endforelse

                        @if ($showLinks2 == 1)
                            {!! $canceled->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('StyleCart')
<link type="text/css" rel="stylesheet" href="{{asset('site/css/outrosite/cart_styles.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('site/css/outrosite/cart_responsive.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('site/css/outrosite/bootstrap.min.css')}}"/>
@endpush


@push('ScriptCart')
<script src="{{asset('site/js/outrosite/cart_custom.js')}}"></script>
<script src="{{asset('site/js/outrosite/bootstrap.min.js')}}"></script>
<script src="{{asset('site/js/outrosite/popper.js')}}"></script>
<script src="{{asset('site/js/shopCart.js')}}"></script>
@endpush

