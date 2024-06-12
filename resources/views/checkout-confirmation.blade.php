@extends('layout.main')
@php
	use App\Models\retur;
@endphp
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
				<h2 class="title_confirmation">Payment received! We're getting your order ready!</h2>

            @elseif ($transaction->htrans_penjualan_status == 3)
				<div class="d-flex justify-content-center">
					<h2 class="title_confirmation text-info w-75 mb-1">Your order is on its way to you!. Let us know that your order has been delivered.</h2>
				</div>
				<a href="{{ route('order-received', $transaction->htrans_penjualan_id) }}" style="font-size: 1em" class="genric-btn small radius py-2 btn-dark m-5 ">Order Received</a>
            
			@elseif ($transaction->htrans_penjualan_status == 4)
			    <h2 class="title_confirmation">Your order has been successfully delivered. Thank you for your purchase!</h2>
            @endif
			
			<div class="row order_d_inner">
				<div class="col-lg-4">
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
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Shipping</h4>
						<ul class="list">
							<li><a href="#"><span>Service</span> : {{ $transaction->service}}</a></li>
							<li><a href="#"><span>ETD</span> : {{ $transaction->etd }} Day</a></li>
							<li><a href="#"><span>Price</span> : {{ formatCurrencyIDR($transaction->service_price) }}</a></li>
							{{-- <li><a href="#"><span>Payment method</span> : Check payments</a></li> --}}
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
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
								<th scope="col" class="">Product</th>
								<th scope="col" class="text-center">Quantity</th>
								<th scope="col" class="">Total</th>
							</tr>
						</thead>
						<tbody>
							@php
								$listProducts = $transaction->dtrans()->get();
                                $subtotalProducts = 0;
							@endphp

							@foreach ($listProducts as $dtrans)
								<tr>
									<td class="align-middle d-flex">
											{{-- <div class="d-flex"> --}}
												<div class="flex-fill align-middle">
                                                    @if ($dtrans->dtrans_penjualan_price < $dtrans->detail->detail_sepatu_harga)
                                                        <h5>{{ $dtrans->detail->sepatu->sepatu_name }} (DEFECT)</h5>
                                                    @else
                                                        <h5>{{ $dtrans->detail->sepatu->sepatu_name }}</h5>
                                                    @endif
													<p>Size : {{ $dtrans->detail->detail_sepatu_ukuran }}</p>
													<p>Color : {{ $dtrans->detail->detail_sepatu_warna }}</p>
												</div>
												@if ($transaction->htrans_penjualan_status == 3)
												<div class="col-4 text-center">
													@if ($dtrans->dtrans_penjualan_retur == null)
                                                        <a href="{{ route('form-retur', $dtrans->dtrans_penjualan_id) }}" class="genric-btn info radius py-1" style="line-height: 12px" id="pay-button">
                                                            Request a Return
                                                        </a>
													@else
                                                        @php
                                                            $retur = retur::where('fk_dtrans', '=', $dtrans->dtrans_penjualan_id)->first();
                                                        @endphp

                                                        @if ($retur->retur_status == 0)
                                                            <a href="{{ route('details-retur', $retur->retur_id) }}" class="genric-btn danger radius py-1" style="line-height: 12px" id="pay-button">
                                                                Return Request Rejected
                                                            </a>
                                                        @elseif ($retur->retur_status == 1)
                                                            <a href="{{ route('details-retur', $retur->retur_id) }}" class="genric-btn success radius py-1" style="line-height: 12px" id="pay-button">
                                                                Return Request Accepted
                                                            </a>
                                                        @elseif ($retur->retur_status == 2)
                                                            <a href="{{ route('details-retur', $retur->retur_id) }}" class="genric-btn primary radius py-1" style="line-height: 12px" id="pay-button">
                                                                Return Requested
                                                            </a>
                                                        @elseif ($retur->retur_status == 9)
                                                            <a href="{{ route('details-retur', $retur->retur_id) }}" class="genric-btn default radius py-1" style="line-height: 12px" id="pay-button">
                                                                Return Cancelled
                                                            </a>
                                                        @endif
													@endif
												</div>
												@endif
											{{-- </div> --}}
									</td>
									<td class="align-middle">
                                        <h5 class="text-center">{{ $dtrans->dtrans_penjualan_qty }}</h5>
									</td>
									<td class="align-middle">
                                        <h5> {{ formatCurrencyIDR( $dtrans->dtrans_penjualan_subtotal) }} </h5>
                                        @php
                                            $subtotalProducts += $dtrans->dtrans_penjualan_subtotal;
                                        @endphp
									</td>
								</tr>
							@endforeach

							<tr>
								<td colspan="2" class="align-middle">
									<h2 class="text-right">TOTAL</h2>
								</td>
								<td class="align-middle">
									<h2>{{ formatCurrencyIDR($subtotalProducts) }}</h2>
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
