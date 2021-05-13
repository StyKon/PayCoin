

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
    <div class="col-3 l-flex-child sleft">
    <div class="option">
<a onclick="filterSelection('all')">
        <img src="https://www.paycoin.tn//storage/photos/1/food_120px.png">
        <div class="category"><div class="b">All</div></div>
      </div></a>
        @foreach($categorys as $category)
      <div class="option">
<a onclick="filterSelection('{{$category->id}}')">
        <img src="{{$category->photo}}">
        <div class="category"><div class="b">{{$category->title}}</div></div>
      </div></a>
        @endforeach

    </div>
    <div class="col-9 l-flex-child-2">
      <div class="row">
      <div id="accordion" class="accordion">
										@if($menu)

											@foreach($menu as $cat_info)
													@if($cat_info->child_cat->count()>0)
													@foreach($cat_info->child_cat as $sub_menu)
               <div class="default open filterDiv {{$sub_menu->cat_id}}">
            <div class="link">  {{$sub_menu->title}} <i class="fa fa-chevron-down"></i></div>
              <div class="submenu l-flex-child-2">
                <div class="row">
                @foreach($sub_menu->providers as $provider)
                    <div class="col-4 remove-padding"><a href="{{route('product-provider',[$cat_info->slug,$sub_menu->slug,$provider->slug])}}"><img src="{{$provider->logo}}"><h8>{{$provider->companyname}}</h8>  </a></div>
                    @endforeach
                </div>
              </div>
</div>
              @endforeach


                        	@endif
											@endforeach

										@endif

      </div>
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
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
@endpush
