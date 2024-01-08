@extends('layout.main')

@php 
	use App\Models\sepatu;
	use App\Models\supplier;
	use App\Models\dtrans;
	use App\Models\retur;
	$userLoggedIn = Session::get('userLoggedIn');

	$listSepatu = sepatu::All();
	$listSupplier = supplier::All();
	$listSepatuDeals = sepatu::inRandomOrder()->limit(6)->get();
	$listSepatuFlashSale = retur::inRandomOrder()->limit(3)->get();

	$latest = sepatu::latest()->take(5)->get();
	$newArrival = sepatu::latest()->take(8)->get();

	$bestSeller = dtrans::select('fk_sepatu')
        ->groupBy('fk_sepatu')
        ->orderByRaw('COUNT(*) DESC')
        ->get();
@endphp

@section('content')
	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						@foreach ($latest as $key => $sepatu)
						@php
						    $brand = '';
							$searchBrand = supplier::where('supplier_id','=',$sepatu->sepatu_supplier_id)->get();
							foreach($searchBrand as $key) {
								$brand = $key->supplier_name;
							}
						@endphp
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h2 ><b style="color:black">{{$sepatu->sepatu_name}} New <br>Collection!</b></h2>
									<p>Introducing the latest collection from {{ $brand }} - 
										<br>Get yours now before it runs out!</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href="{{ route('add-to-cart', ['id'=>$sepatu->sepatu_id]) }}"><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Add to Bag</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="{{ Storage::url("photo/$sepatu->sepatu_pict") }}" alt="">								
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Extensive Variety</h6>
						<p>Providing All Variety of Shoes</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Return Policy</h6>
						<p>Items can be exchanged</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>Exclusive Offers</h6>
						<p>Giving Extra Discounts</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Secure Payment</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<div class="single-deal">
								<a href="{{ route('product-category', 2) }}" >
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/c1.jpg" alt="">
									<div class="deal-details">
										<h6 class="deal-title">Sneakers</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<a href="{{ route('product-category', 1) }}" >
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/c2.jpg" alt="">
									<div class="deal-details">
										<h6 class="deal-title">Sports</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<a href="{{ route('product-category', 7) }}">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/c3.jpg" alt="">
									<div class="deal-details">
										<h6 class="deal-title">Sandals</h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="single-deal">
								<a href="{{ route('product-category', 3) }}">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/c4.jpg" alt="">
									<div class="deal-details">
										<h6 class="deal-title">Heels</h6>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-deal">
						<a href="{{ route('product-category', 5) }}">
						<div class="overlay"></div>
						<img class="img-fluid w-100" src="img/category/c5.jpg" alt="">
							<div class="deal-details">
								<h6 class="deal-title">Boots</h6>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products</h1>
							<p>Introducing our latest shoe collection - a blend of style, comfort, and innovation that redefines footwear.</p>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach ($newArrival as $key => $sepatu)
					@if($sepatu->deleted_at == null && $sepatu->sepatu_stock > 0)
					<!-- single product -->
					<a href="{{ route('product-detail', $sepatu->sepatu_id) }}">
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="{{ Storage::url("photo/$sepatu->sepatu_pict") }}" alt="">
							<div class="product-details">
								<h6>{{$sepatu->sepatu_name}}</h6>
								<div class="price">
									<h6>{{ formatCurrencyIDR($sepatu->sepatu_price)}}</h6>
									<h6 class="l-through">{{ formatCurrencyIDR($sepatu->sepatu_price + 50000) }}</h6>
								</div>
								<div class="prd-bottom">
									<a href="{{ route('add-to-cart', ['id'=>$sepatu->sepatu_id]) }}" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="{{ route('checkout-product', $sepatu->sepatu_id) }}" class="social-info">
										<span class="ti-money"></span>
										<p class="hover-text">checkout</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					</a>
					@endif
					@endforeach
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Best Seller</h1>
							<p>Discover perfection in every step with our bestseller shoes! Renowned for their impeccable style, unparalleled comfort, and enduring quality, these shoes have become a favorite among fashion enthusiasts worldwide.</p>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach ($bestSeller as $key=>$best)
						@foreach ($listSepatu as $key=>$sepatu)
						@if($sepatu->deleted_at == null && $sepatu->sepatu_id == $best->fk_sepatu&& $sepatu->sepatu_stock > 0)
						<!-- single product -->
						<a href="{{ route('product-detail', $sepatu->sepatu_id) }}">
							<div class="col-lg-3 col-md-6">
								<div class="single-product">
									<img class="img-fluid" src="{{ Storage::url("photo/$sepatu->sepatu_pict") }}" alt="">
									<div class="product-details">
										<h6>{{$sepatu->sepatu_name}}</h6>
										<div class="price">
											<h6>{{ formatCurrencyIDR($sepatu->sepatu_price)}}</h6>
											<h6 class="l-through">{{ formatCurrencyIDR($sepatu->sepatu_price + 50000) }}</h6>
										</div>
										<div class="prd-bottom">
											<a href="{{ route('add-to-cart', ['id'=>$sepatu->sepatu_id]) }}" class="social-info">
												<span class="ti-bag"></span>
												<p class="hover-text">add to bag</p>
											</a>
											<a href="{{ route('checkout-product', $sepatu->sepatu_id) }}" class="social-info">
												<span class="ti-money"></span>
												<p class="hover-text">checkout</p>
											</a>
										</div>
									</div>
								</div>
							</div>
						</a>
						@endif
						@endforeach
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
	<section class="exclusive-deal-area">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1>Exclusive Hot Deal Ends Soon!</h1>
							<p>Who are in extremely love with eco friendly system.</p>
						</div>
					</div>
					<a href="{{ route('flashsale') }}" class="primary-btn">Shop Now</a>
				</div>
				<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">
						@foreach ($listSepatuFlashSale as $key => $retur)
						<!-- single exclusive carousel -->
						<div class="single-exclusive-slider">
							<img class="img-fluid" src="{{ Storage::url("retur/$retur->retur_foto") }}" alt="">
							<div class="product-details">
								<div class="price">
									<h6>{{ formatCurrencyIDR($retur->retur_price) }}</h6>
									<h6 class="l-through">{{ formatCurrencyIDR($retur->retur_price + 50000) }}</h6>
								</div>
								<h4>{{ $retur->sepatu->sepatu_name }}</h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									<a class="add-btn" href=""><span class="ti-bag"></span></a>
									<span class="add-text text-uppercase">Add to Bag</span>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				@foreach ($listSupplier as $key => $brand)
				<a class="col single-img" href="products/brand/{{$brand->supplier_id}}">
					<img class="img-fluid d-block mx-auto" src="{{ Storage::url("photo/$brand->supplier_logo") }}" alt="">
				</a>
				@endforeach
			</div>
		</div>
	</section>
	<!-- End brand Area -->

	<!-- Start related-product Area -->
	@include('layout.deals-of-the-week')
	
@endsection
    <!-- End related-product Area -->

	<!-- start footer Area -->
	{{-- <footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer> --}}
	<!-- End footer Area -->
{{--
	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html> --}}
