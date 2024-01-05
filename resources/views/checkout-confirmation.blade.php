@extends('layout.main')

@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Order Details</h1>
					<nav class="d-flex align-items-center">
						<a href="/home">Home <span class="lnr lnr-arrow-right"></span></a>
						<a href="/orders">Orders <span class="lnr lnr-arrow-right"></a>
						<a href="">Status</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
            @if ($transaction->htrans_penjualan_status == 0)
			    <h2 class="title_confirmation text-danger">Your order has been cancelled.</h2>
            @elseif ($transaction->htrans_penjualan_status == 1)
			    <h2 class="title_confirmation text-warning">Waiting for payment.</h2>
                <div class="d-flex justify-content-center m-3">
                    <button type="button" class="genric-btn danger circle mx-3" style="font-size: 1rem" id="cancel-button">
                        Cancel
                    </button>
                    <button type="button" class="genric-btn primary circle mx-3" style="font-size: 1rem" id="pay-button">
                        Payment
                    </button>
                </div>
            @elseif ($transaction->htrans_penjualan_status == 2)
			    <h2 class="title_confirmation text-info">Thank you. Your order has been processed and to be picked up at our store</h2>
            @elseif ($transaction->htrans_penjualan_status == 3)
			    <h2 class="title_confirmation">Your order has been picked up.</h2>
            @endif
			<div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Order Info</h4>
						<ul class="list">
							<li><a href="#"><span>Order number</span> : {{ $transaction->htrans_penjualan_id}}</a></li>
							<li><a href="#"><span>Date</span> : {{ $transaction->created_at }}</a></li>
							<li><a href="#"><span>Total</span> : {{ formatCurrencyIDR($transaction->htrans_penjualan_total) }}</a></li>
							{{-- <li><a href="#"><span>Payment method</span> : Check payments</a></li> --}}
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Customer Info</h4>
						<ul class="list">
							<li><a href="#"><span>Name</span> : {{ $transaction->customer->user_name }}</a></li>
							<li><a href="#"><span>Email</span> : {{ $transaction->customer->user_email }}</a></li>
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
                                        <div class="d-flex">
                                            <div class="flex-fill align-middle">
                                                <h5">{{ $p->sepatu->sepatu_name }}</h5>
                                                <p">{{ $p->sepatu->ukuran->ukuran_sepatu_nama }}</p>
                                            </div>
                                            @if ($transaction->htrans_penjualan_status == 3)
                                            <div class="col-3">
                                                <a href="{{ route('form-retur')}}" class="genric-btn info radius py-1" style="line-height: 15px" id="pay-button">
                                                    Apply Return Product
                                                </a>
                                            </div>
                                            @endif
                                        </div>
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
							{{-- <tr>
								<td>
									<h4>Shipping</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>Flat rate: $50.00</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>$2210.00</p>
								</td>
							</tr> --}}
						</tbody>
					</table>
				</div>
			</div>
            <div class="d-flex justify-content-end">
                <a class="primary-btn m-3" href="/products">Continue Shopping</a>
            </div>
		</div>
	</section>
	<!--================End Order Details Area =================-->

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $transaction->snap_token }}', {
                onSuccess: function(result){
                    window.location.href = '{{ route('checkout-success', $transaction->htrans_penjualan_id) }}';
                },
            });
        };

        document.getElementById('cancel-button').onclick = function(){
            window.location.href = '{{ route('checkout-cancel', $transaction->htrans_penjualan_id) }}';
        }
    </script>

@endsection
