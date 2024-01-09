@extends('layout.main')

@php
	use App\Models\sepatu;
	use App\Models\kategori;
	use App\Models\ukuran;
	use App\Models\supplier;
	$userLoggedIn = Session::get('userLoggedIn');
	$listSepatu = sepatu::All();
	$listUkuran = ukuran::All();
	$listCategory = kategori::all();
	$listBrand = supplier::all();

	$kategori = '' ;
	$ukuran = '' ;
	$brand = '' ;


	foreach($listCategory as $key) {
		if ($key->kategori_id == $sepatu['kategori']) {
			$kategori = $key->kategori_nama;
		}
	}

	foreach($listUkuran as $key) {
		if ($key->ukuran_sepatu_id == $sepatu['ukuran']) {
			$ukuran = $key->ukuran_sepatu_nama;
		}
	}

	foreach($listBrand as $key) {
		if ($key->supplier_id == $sepatu['supplier']) {
			$brand = $key->supplier_name;
		}
	}

@endphp

@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Product</h1>
					<nav class="d-flex align-items-center">
						<a href="/home">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="/products">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="/products/{{$sepatu['id']}}">Detail</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6 mt-5">
						<img class="object-fit-cover img-fluid" src="{{ Storage::url("retur/$retur->retur_foto") }}" style="width:40vw; height:50vh" alt="">
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $sepatu['name'] }}</h3>
                        <div class="d-flex align-bottom">
									<h2>{{ formatCurrencyIDR($retur->retur_price) }}</h2>
									<h6 class="pl-1" style="text-decoration: line-through">{{ formatCurrencyIDR($sepatu['price']) }}</h6>
                        </div>
						{{-- <h2>{{ formatCurrencyIDR($retur->retur_price) }} <small class="text-decoration-line-through" style="text-decoration: line-through">{{ formatCurrencyIDR($sepatu['price']) }}</small></h2> --}}
						<ul class="list">
							<li><a class="active" href="category/{{$sepatu['kategori']}}"><span>Category</span> : {{ $kategori }}</a></li>
							<li><a class="active" href="brand/{{$sepatu['supplier']}}"><span>Brand</span> : {{ $brand }}</a></li>
						</ul>
						<p>
							{{ $sepatu['name'] }} <br>
							Size : {{ $ukuran }} <br>
							Color : {{ $sepatu['color'] }} <br>
							Stock : {{ $sepatu['stock'] }}
						</p>
						<div class="card_area d-flex align-items-center">
							{{-- <a class="icon_btn" href="{{ route('add-to-cart', ['id'=>$sepatu['id']]) }}"><i class="ti-bag"></i></a> --}}
							<a class="primary-btn" href="{{ route('checkout-product-retur',) }}"><i class="ti-money"></i>Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist" style="height:3vh">

			</ul>

		</div>
	</section>
	<!--================End Product Description Area =================-->

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Deals of the Week</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r1.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r2.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r3.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r5.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r6.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r7.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r9.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r10.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r11.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ctg-right">
						<a href="#" target="_blank">
							<img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End related-product Area -->


@endsection
