<!-- shop -->
<div class="shop">
    <a href="{{route('service.show', $serviceAll->id)}}">
        <div class="shop-img">
            <img src=" {{asset('site/img/shop01.png')}}" alt=" {{$serviceAll->name}} ">
        </div>
        <div class="shop-body">
            <h3>{{$serviceAll->name}}</h3>
            <p class="cta-btn">Ler mais <i class="fa fa-arrow-circle-right"></i></p>
        </div>
    </a>
</div>
<!-- /shop -->
