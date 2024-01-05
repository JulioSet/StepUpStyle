@extends('layout.main')

@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Confirmation</h1>
					<nav class="d-flex align-items-center">
						<a href="/home">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="/confirmation">Checkout Cancelled</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container align-middle justify-items-center">
            <h1><span class="lnr lnr-sad" id="profile"></span></h1>
			<h3 class="text-danger">Your order has been cancelled.</h3>
			{{-- <div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Order Info</h4>
						<ul class="list">
							<li><a href="#"><span>Order number</span> : {{ $transaction->htrans_penjualan_id}}</a></li>
							<li><a href="#"><span>Date</span> : {{ $transaction->created_at }}</a></li>
							<li><a href="#"><span>Total</span> : {{ formatCurrencyIDR($transaction->htrans_penjualan_total) }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Customer Info</h4>
						<ul class="list">
							<li><span>Name</span> : {{ $transaction->customer->user_name }}</li>
							<li><span>Email</span> : {{ $transaction->customer->user_email }}</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Order Details</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
                            @php
                                $listProducts = $transaction->dtrans()->get();
                            @endphp

                            @foreach ($listProducts as $p)
                                <tr>
                                    <td class="align-middle">
                                        <h5>{{ $p->sepatu->sepatu_name }}</h5>
                                        <p>{{ $p->sepatu->ukuran->ukuran_sepatu_nama }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <h5>{{ $p->dtrans_penjualan_qty}}</h5>
                                    </td>
                                    <td class="align-middle">
                                        <h5> {{ formatCurrencyIDR( $p->dtrans_penjualan_subtotal) }} </h5>
                                    </td>
                                </tr>
                            @endforeach

							<tr>
								<td colspan="2" class="align-middle">
									<h2 class="text-right">TOTAL</h2>
								</td>
								<td class="align-middle">
									<h2>{{ formatCurrencyIDR( $transaction->htrans_penjualan_total) }}</h2>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div> --}}
            <div class="d-flex justify-content-end">
                <a class="primary-btn m-3" href="/products">Continue Shopping</a>
            </div>
		</div>
	</section>
	<!--================End Order Details Area =================-->

@endsection
