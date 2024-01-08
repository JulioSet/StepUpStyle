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
				<div class="col-lg-6">
					<img src="{{ Storage::url("photo/$sepatu[picture]") }}" class="img-fluid"  alt="">
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $sepatu['name'] }}</h3>
						<h2>{{ formatCurrencyIDR($sepatu['price']) }}</h2>
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
                            <a class="icon_btn" href="{{ route('add-to-cart', ['id'=>$sepatu['id']]) }}"><i class="ti-bag"></i></a>
							<a class="primary-btn" href="{{ route('checkout-product', ['id'=>$sepatu['id']]) }}"><i class="ti-money"></i>Checkout</a>
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

	@include('layout.deals-of-the-week')
	
	<!-- End related-product Area -->


@endsection
