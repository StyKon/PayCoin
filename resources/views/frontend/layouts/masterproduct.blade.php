<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')
</head>
<body class="js">

	{{--<!-- Preloader -->--}}
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	{{--<!-- End Preloader -->--}}

	@include('frontend.layouts.notification')
	{{--<!-- Header -->--}}
	@include('frontend.layouts.header')
	{{--<!--/ End Header -->--}}
	@yield('main-content')
	{{--	<!-- /End Footer Area --> --}}

{{--	<!-- Jquery --> --}}
   <script src="{{asset('frontend/js/jquery.min.js')}}" ></script>
   <script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
   <script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
{{--	<!-- Popper JS --> --}}
   <script src="{{asset('frontend/js/popper.min.js')}}"></script>
{{--	 <!-- Bootstrap JS -->  --}}
   <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
 {{--	<!-- Slicknav JS --> --}}
   <script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
{{--	<!-- Owl Carousel JS --> --}}
   <script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
{{--	<!-- Magnific Popup JS --> --}}
   <script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
{{--	<!-- Waypoints JS --> --}}
   <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
{{--	<!-- Countdown JS --> --}}
   <script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
{{--	<!-- Nice Select JS --> --}}
   <script src="{{asset('frontend/js/nicesellect.js')}}"></script>
{{--	<!-- Flex Slider JS --> --}}
   <script src="{{asset('frontend/js/flex-slider.js')}}"></script>
{{--	<!-- Onepage Nav JS --> --}}
   <script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
   {{-- Isotope --}}
   <script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
{{--	<!-- Easing JS --> --}}
   <script src="{{asset('frontend/js/easing.js')}}" ></script>
   {{--	<!-- Category Slide JS --> --}}
   <script src="{{asset('frontend/js/category-slide.js')}}"></script>

{{--	<!-- Active JS --> --}}
   <script src="{{asset('frontend/js/active.js')}}"></script>
   {{--	<!-- Slick JS --> --}}
   <script src="{{asset('frontend/slick/slick.js')}}"></script>
   <script src="{{asset('frontend/slick/slick.min.js')}}"></script>

   @stack('scripts')
   <script>
	   setTimeout(function(){
		 $('.alert').slideUp();
	   },5000);
	   $(function() {
	   // ------------------------------------------------------- //
	   // Multi Level dropdowns
	   // ------------------------------------------------------ //
		   $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
			   event.preventDefault();
			   event.stopPropagation();

			   $(this).siblings().toggleClass("show");


			   if (!$(this).next().hasClass('show')) {
			   $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
			   }
			   $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
			   $('.dropdown-submenu .show').removeClass("show");
			   });

		   });
	   });
	 </script>

</body>
</html>
