@extends('frontend.layouts.master')
@if($agent->isMobile())
@section('meta')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@endsection
@endif
@section('title','PayCoin || HOME PAGE')
@section('main-content')
{{--<!-- Slider Area -->--}}
@if(count($banners)>0)
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
        @endforeach

    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($banners as $key=>$banner)
        <div class="carousel-item {{(($key==0)? 'active' : '')}}">
            <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-left">
                <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                <p>{!! html_entity_decode($banner->description) !!}</p>
                <a class="btn btn-lg ws-btn wow fadeInUpBig" href="" role="button">Shop Now<i
                        class="far fa-arrow-alt-circle-right"></i></i></a>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>
@endif

{{--<!-- Start All Category -->--}}
<section class="main-cat" role="main-cat">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h2>Category</h2>
            </div>
        </div>
    </div>
    <div class="content-cat">
        @php
        $category_lists=DB::table('categories')->where('status','active')->get();
        @endphp
        <div class="slider responsivecat-2" id="carousel">
            @if($category_lists)

            @foreach($category_lists as $cat)
            @if($cat)
            {{--  <!-- Single Banner  -->--}}
            <div class="category-slide">
                @if($cat->photo)
                <a href="{{route('product-cat',$cat->slug)}}" target="_blank"><img src="{{$cat->photo}}"
                        alt="{{$cat->photo}}"></a>
                @else
                <img src="https://via.placeholder.com/600x370" alt="#">
                @endif
                <p>{{$cat->title}}</p>
            </div>
            @endif
            {{-- <!-- /End Single Banner  -->--}}
            @endforeach
            @endif
        </div>
    </div>
</section>
{{--<!-- End All Category -->--}}
{{--<!-- Start Hot Item Category -->--}}

@foreach($category_lists as $cat)

@php
$product1=App\Models\Product::where('cat_id',$cat->id)->where('condition','hot')->get();
$product2=App\Models\Product::where('cat_id',$cat->id)->where('condition','rec')->get();
@endphp
@if(!(($product2->isEmpty())&&($product1->isEmpty())))
<?php $col = 5 ?>
@if((($product2->isEmpty())||($product1->isEmpty())))
<?php $col = 12 ?>
@endif
<section class="main-cat" role="main-cat">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h2>{{$cat->title}}</h2>
            </div>
        </div>
    </div>
    <div class="content-cat">
        <div class="row justify-content-center">
        @if(!$product1->isEmpty())
            <div class="col-md-<?php echo $col ?> mr-auto text-center">
            <h5>Recommended</h5>
                <div class="slider responsivecat mt-4"  id="carousel">
                    @foreach($product1 as $pr)

                    {{--  <!-- Single Banner  -->--}}
                    <div class="category-slide">
                        @if($pr->photo)
                        <a href="" target="_blank"><img src="{{$pr->photo}}" alt="{{$pr->photo}}"></a>
                        @else
                        <img src="https://via.placeholder.com/600x370" alt="#">
                        @endif
                        <b><p class="my-1">{{Str::limit($pr->title,8)}}</p></b>
                        <p class="my-1">{{$pr->price}} TND</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @if(!$product2->isEmpty())
            <div class="col-md-<?php echo $col ?>  ml-auto text-center">
                <h5>Hot products</h5>
                <div class="slider responsivecat mt-4" id="carousel">

                    @foreach($product2 as $pr)

                    {{--  <!-- Single Banner  -->--}}
                    <div class="category-slide ">
                        @if($pr->photo)
                        <a href="" target="_blank"><img src="{{$pr->photo}}" alt="{{$pr->photo}}"></a>
                        @else
                        <img src="https://via.placeholder.com/600x370" alt="#">
                        @endif
                        <b><p class="my-1">{{Str::limit($pr->title,8)}}</p></b>
                        <p class="my-1">{{$pr->price}} TND</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
@endforeach


{{--<!-- End Hot Item Categor -->--}}


{{--<!-- Start Shop Services Area -->--}}
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                {{-- <!-- Start Single Service -->--}}
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
                </div>
                {{--  <!-- End Single Service -->--}}
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                {{--  <!-- Start Single Service -->--}}
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                {{--<!-- End Single Service -->--}}
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                {{-- <!-- Start Single Service -->--}}
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                {{--  <!-- End Single Service -->--}}
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                {{-- <!-- Start Single Service -->--}}
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                {{-- <!-- End Single Service -->--}}
            </div>
        </div>
    </div>
</section>
{{--<!-- End Shop Services Area -->--}}

@include('frontend.layouts.newsletter')

{{--<!-- Modal -->--}}
@if($product_lists)
@foreach($product_lists as $key=>$product)
<div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                        aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        {{--  <!-- Product Slider -->--}}
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                @php
                                $photo=explode(',',$product->photo);
                                // dd($photo);
                                @endphp
                                @foreach($photo as $data)
                                <div class="single-slider">
                                    <img src="{{$data}}" alt="{{$data}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <!-- End Product slider -->--}}
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>{{$product->title}}</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        {{-- <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="fa fa-star"></i> --}}
                                        @php
                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                        @endphp
                                        @for($i=1; $i<=5; $i++) @if($rate>=$i)
                                            <i class="yellow fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            @endif
                                            @endfor
                                    </div>
                                    <a href="#"> ({{$rate_count}} customer review)</a>
                                </div>
                                <div class="quickview-stock">
                                    @if($product->stock >0)
                                    <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                    @else
                                    <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out
                                        stock</span>
                                    @endif
                                </div>
                            </div>
                            @php
                            $after_discount=($product->price-($product->price*$product->discount)/100);
                            @endphp
                            <h3><small><del class="text-muted">{{number_format($product->price,2)}} TND</del></small>
                                {{number_format($after_discount,2)}} TND</h3>
                            <div class="quickview-peragraph">
                                <p>{!! html_entity_decode($product->summary) !!}</p>
                            </div>
                            @if($product->size)
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Size</h5>
                                        <select>
                                            @php
                                            $sizes=explode(',',$product->size);
                                            // dd($sizes);
                                            @endphp
                                            @foreach($sizes as $size)
                                            <option>{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                @csrf
                                <div class="quantity">
                                    {{-- <!-- Input Order -->--}}
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled"
                                                data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="slug" value="{{$product->slug}}">
                                        <input type="text" name="quant[1]" class="input-number" data-min="1"
                                            data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    {{--<!--/ End Input Order -->--}}
                                </div>
                                <div class="add-to-cart">
                                    <button type="submit" class="btn">Add to cart</button>
                                    <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i
                                            class="ti-heart"></i></a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
{{--<!-- Modal end -->--}}
@endsection

@push('styles')

@if($agent->isMobile())
<style>
/* Banner Sliding */
#Gslider .carousel-inner {
    background: #000000;
    color: black;
}

#Gslider .carousel-inner {
    /* height: 550px; */
}

#Gslider .carousel-inner img {
    width: 100% !important;
    opacity: .8;
}

#Gslider .carousel-inner .carousel-caption {
    bottom: 60%;
}

#Gslider .carousel-inner .carousel-caption h1 {
    font-size: 50px;
    font-weight: bold;
    line-height: 100%;
    color: #F7941D;
}

#Gslider .carousel-inner .carousel-caption p {
    font-size: 18px;
    color: black;
    margin: 28px 0 28px 0;
}

#Gslider .carousel-indicators {
    bottom: 70px;
}
</style>
@else
<style>
/* Banner Sliding */
#Gslider .carousel-inner {
    background: #000000;
    color: black;
}

#Gslider .carousel-inner {
    height: 550px;
}

#Gslider .carousel-inner img {
    width: 100% !important;
    opacity: .8;
}

#Gslider .carousel-inner .carousel-caption {
    bottom: 60%;
}

#Gslider .carousel-inner .carousel-caption h1 {
    font-size: 50px;
    font-weight: bold;
    line-height: 100%;
    color: #F7941D;
}

#Gslider .carousel-inner .carousel-caption p {
    font-size: 18px;
    color: black;
    margin: 28px 0 28px 0;
}

#Gslider .carousel-indicators {
    bottom: 70px;
}
</style>
@endif
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

{{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
type:"POST",
data:{
_token:"{{csrf_token()}}",
quantity:quantity,
pro_id:pro_id
},
success:function(response){
console.log(response);
if(typeof(response)!='object'){
response=$.parseJSON(response);
}
if(response.status){
swal('success',response.msg,'success').then(function(){
// document.location.href=document.location.href;
});
}
else{
window.location.href='user/login'
}
}
})
});
</script> --}}
{{-- <script>
        $('.wishlist').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            // alert(pro_id);
            $.ajax({
                url:"{{route('add-to-wishlist')}}",
type:"POST",
data:{
_token:"{{csrf_token()}}",
quantity:quantity,
pro_id:pro_id,
},
success:function(response){
if(typeof(response)!='object'){
response=$.parseJSON(response);
}
if(response.status){
swal('success',response.msg,'success').then(function(){
document.location.href=document.location.href;
});
}
else{
swal('error',response.msg,'error').then(function(){
// document.location.href=document.location.href;
});
}
}
});
});
</script> --}}
<script>
/*==================================================================
        [ Isotope ]*/
var $topeContainer = $('.isotope-grid');
var $filter = $('.filter-tope-group');

// filter items on button click
$filter.each(function() {
    $filter.on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $topeContainer.isotope({
            filter: filterValue
        });
    });

});

// init Isotope
$(window).on('load', function() {
    var $grid = $topeContainer.each(function() {
        $(this).isotope({
            itemSelector: '.isotope-item',
            layoutMode: 'fitRows',
            percentPosition: true,
            animationEngine: 'best-available',
            masonry: {
                columnWidth: '.isotope-item'
            }
        });
    });
});

var isotopeButton = $('.filter-tope-group button');

$(isotopeButton).each(function() {
    $(this).on('click', function() {
        for (var i = 0; i < isotopeButton.length; i++) {
            $(isotopeButton[i]).removeClass('how-active1');
        }
        $(this).addClass('how-active1');
    });
});
</script>
<script>
function cancelFullScreen(el) {
    var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
    if (requestMethod) { // cancel full screen.
        requestMethod.call(el);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

function requestFullScreen(el) {
    // Supports most browsers and their versions.
    var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el
        .msRequestFullscreen;

    if (requestMethod) { // Native full screen.
        requestMethod.call(el);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
    return false
}
</script>

@endpush
