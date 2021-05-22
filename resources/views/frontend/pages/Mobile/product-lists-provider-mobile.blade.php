

<form action="{{route('shop.filter')}}" method="POST">
		@csrf
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="javascript:void(0);">Shop List</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
    </div>

	{{--	<!-- End Breadcrumbs -->--}}
<section class="product-area shop-sidebar shop-list shop section">
<div class="container-fluid">
  <div class="row">
    <div class="col-3 l-flex-child-2 sleft">
    <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
    <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png" data-filter="*">
        <div class="category"><div class="b">All</div></div>
      </div>
    @foreach($smallcategorys as $smallcat)
      <div class="option">
        <img src="{{$smallcat->photo}}" data-filter=".{{$smallcat->id}}">
        <div class="category"><div class="b">{{$smallcat->title}}</div> </div>
      </div>
    @endforeach
    </ul>
    </div>
    <div class="col-9 l-flex-child">
      <div class="row tab-content isotope-grid" id="myTabContent">

      @if(count($products))
	   @foreach($products as $product)
       <div class="col-6  isotope-item {{$product->small_cat_id}}">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{route('product-detail',$product->slug)}}">
                                                    @php

                                                        $photo=explode(',',$product->photo);
                                                    @endphp
                                                    <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    @if($product->discount)
                                                                <span class="price-dec">-{{$product->discount}}%</span>
                                                    @endif
                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                    </div>
                                                    <div class="product-action-2">
                                                        <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                                @php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <span>${{number_format($after_discount,2)}}</span>
                                                <del style="padding-left:4%;">${{number_format($product->price,2)}}</del>
                                            </div>
                                        </div>
                                    </div>
	   @endforeach
	  @else
		<h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
      @endif

    </div>

  </div>

  </section>
			{{--<!--/ End Product Style 1  -->--}}
		</form>


</div>
@push('scripts')
<script>
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}

	var accordion = new Accordion($('#accordion'), false);
});


</script>
<script>

/*==================================================================
[ Isotope ]*/
var $topeContainer = $('.isotope-grid');
var $filter = $('.filter-tope-group');

// filter items on button click
$filter.each(function () {
    $filter.on('click', 'img', function () {
        var filterValue = $(this).attr('data-filter');
        $topeContainer.isotope({filter: filterValue});
    });

});

// init Isotope
$(window).on('load', function () {
    var $grid = $topeContainer.each(function () {
        $(this).isotope({
            itemSelector: '.isotope-item',
            layoutMode: 'fitRows',
            percentPosition: true,
            animationEngine : 'best-available',
            masonry: {
                columnWidth: '.isotope-item'
            }
        });
    });
});

var isotopeButton = $('.filter-tope-group button');

$(isotopeButton).each(function(){
    $(this).on('click', function(){
        for(var i=0; i<isotopeButton.length; i++) {
            $(isotopeButton[i]).removeClass('how-active1');
        }
        $(this).addClass('how-active1');
    });
});
</script>
<style>
.col-6{
 padding-left:2px;
padding-right:2px;
}</style>
@endpush
