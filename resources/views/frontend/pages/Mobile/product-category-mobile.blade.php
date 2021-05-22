

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
    <div id="myBtnContainer">
    <div class="option">
<a class="FilterClick" onclick="filterSelection('all')">
        <img src="https://www.paycoin.tn//storage/photos/1/food_120px.png">
        <div class="category"><div class="b">All</div></div>
      </div></a>
        @foreach($childcategorys as $childcategory)
      <div class="option">
<a class="FilterClick" onclick="filterSelection('{{$childcategory->id}}')">
        <img src="{{$childcategory->photo}}">
        <div class="category"><div class="b">{{$childcategory->title}}</div></div>
      </div></a>
        @endforeach
</div>
    </div>
    <div class="col-9 l-flex-child">
      <div class="row scrolling-pagination">

      @if(count($products))
	   @foreach($products as $product)
       <div class="col-6 filterDiv {{$product->child_cat_id}} ">
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
      {{$products->links()}}
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

<style>
    .filterDiv {
  display: none;
}

.show {
  display: block;
}
.scrolling-pagination {
    overflow : hidden;
}
</style>

<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("FilterClick");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function() {
                $('ul.pagination').remove();
                 $(".scrolling-pagination").css({'margin-left': 0 , 'margin-right':0});
                $(".l-flex-child").css({'padding-right': 0 , 'padding-left':0});
            }
        });
    });
</script>
<style>
.col-6{
 padding-left:5px;
padding-right:5px;
}</style>
@endpush
