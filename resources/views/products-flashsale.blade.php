@extends('layout.main')

@php
	use App\Models\sepatu;
	$userLoggedIn = Session::get('userLoggedIn');
	$listSepatu = sepatu::All();
@endphp

@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Flash Sale</h1>
					<nav class="d-flex align-items-center">
						<a href="/home">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="/products">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="/products">Flash Sale</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<div class="container">
		<div class="row">
			@include('layout.sidebar')
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						@forelse ($listSepatu as $key=>$sepatu)
						<!-- single product -->
							{{-- @if($sepatu->deleted_at == null) --}}
								<a href="{{ route('product-retur', $sepatu->retur_id) }}">
								<div class="col-lg-4 col-md-6">
									<div class="single-product">
										<img class="img-fluid" src="{{ Storage::url("photo/$retur->retur_pict") }}" alt="">
										<div class="product-details">
											<h6>{{ $retur->sepatu->sepatu_name }}</h6>
											<div class="price">
												<h6>{{ formatCurrencyIDR($retur->retur_price) }}</h6>
												<h6 class="l-through">{{ formatCurrencyIDR($retur->sepatu->sepatu_price) }}</h6>
											</div>
											<div class="prd-bottom">
												{{-- <a href="{{ route('add-to-cart', $sepatu->retur_id) }}" class="social-info">
													<span class="ti-bag"></span>
													<p class="hover-text">add to bag</p>
												</a> --}}
												<a href="{{ route('checkout-product-retur', $sepatu->retur_id) }}" class="social-info">
													<span class="ti-money"></span>
													<p class="hover-text">checkout</p>
												</a>
											</div>
										</div>
									</div>
								</div>
								</a>
							{{-- @endif --}}
						@empty
							<h1 style="margin:auto">No Products Yet</h1>
						@endforelse
					</div>
				</section>
			</div>
		</div>
	</div>

@endsection
