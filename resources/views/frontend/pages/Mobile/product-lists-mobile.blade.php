

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
        categorie
      <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png" >   
        <div class="category">T-shirts</div>
      </div>
    
  <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png">
        <div class="category">T-shirts</div>
      </div>
  
  <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png">
        <div class="category">T-shirts</div>
      </div>
  
      <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png">
        <div class="category">T-shirts</div>
      </div>
  <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png">
        <div class="category">T-shirts</div>
      </div>
  <div class="option">
        <img src="https://www.paycoin.tn/storage/photos/1/food_120px.png">
        <div class="category">T-shirts</div>
      </div>
      <div class="option">
        <img src="https://www.w3schools.com/w3images/avatar2.png">
        <div class="category">T-shirts</div>
      </div>
      <div class="option">
        <img src="https://www.w3schools.com/w3images/avatar2.png">
        <div class="category">T-shirts</div>
      </div>
      <div class="option">
        <img src="https://www.w3schools.com/w3images/avatar2.png">
        <div class="category">T-shirts</div>
      </div>
                            
    </div>
    <div class="col-9 l-flex-child-2">
      <div class="row">
      <div id="accordion" class="accordion">
      @php
											// $category = new Category();
											$menu=App\Models\Category::getAllParentWithChild();
										@endphp
										@if($menu)
								
											@foreach($menu as $cat_info)
													@if($cat_info->child_cat->count()>0)
													@foreach($cat_info->child_cat as $sub_menu)
            <div class="link"><i class="fa fa-database"></i>{{$sub_menu->title}}<i class="fa fa-chevron-down"></i></div>
              <div class="submenu l-flex-child-2">
                <div class="row">
                    <div class="col-4 remove-padding"><img src="http://fakeimg.pl/365x365/"><h8>T-shirts</h8> </div>
                    <div class="col-4 remove-padding"><img src="http://fakeimg.pl/365x365/"> <h8>T-shirts</h8></div>
                    <div class="col-4 remove-padding"><img src="http://fakeimg.pl/365x365/"> <h8>T-shirts</h8> </div>
                    <div class="col-4 remove-padding"><img src="http://fakeimg.pl/365x365/"> <h8>T-shirts</h8> </div>
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

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});


</script>
@endpush