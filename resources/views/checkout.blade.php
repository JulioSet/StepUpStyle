@extends('layout.main')

@php
	use App\Models\sepatu;
	use App\Models\retur;
	// use App\Models\htrans;

    // $transaction = htrans::find($htrans_penjualan_id);
    // $userLoggedIn = Session::get('userLoggedIn');
@endphp

@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/home">Home <span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            {{-- <form class="row contact_form" action="payment" method="post" novalidate="novalidate"> --}}
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Customer Details</h3>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ $userLoggedIn['name'] }}" disabled>
                            </div>
                            {{-- <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ $userLoggedIn['email'] }}" disable>
                            </div> --}}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" value="{{ $userLoggedIn['email'] }}" disabled>
                            </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="flex-fill">Product</th>
                                            <th class="col-2">Price</th>
                                            <th class="col-2">Quantity</th>
                                            <th class="col-2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotalProducts = 0;
                                        @endphp
                                        @forelse ($cartSepatu as $c)
                                            @if ($c['id']<1001)
                                                @php
                                                    $sepatu = sepatu::find($c['id']);
                                                @endphp
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="media">
                                                            <div class="d-flex col-4">
                                                                <img class="img-fluid" src="{{ Storage::url("photo/$sepatu->sepatu_pict") }}" alt="">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <p class="p-0 m-0">{{ $sepatu->sepatu_name }}</p>
                                                                <p class="p-0 m-0">Size : {{ $sepatu->ukuran->ukuran_sepatu_nama }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <p>{{ formatCurrencyIDR($sepatu->sepatu_price) }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <p>{{ $c['qty'] }} pcs</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        @php
                                                            $total = $sepatu->sepatu_price * $c['qty'];
                                                            $subtotalProducts += $total;
                                                        @endphp
                                                        <p>{{ formatCurrencyIDR($total) }}</p>
                                                    </td>
                                                </tr>
                                            @else
                                                @php
                                                    $retur = retur::find($c['id']-1000)
                                                @endphp
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="media">
                                                            <div class="d-flex col-4">
                                                                <img class="img-fluid" src="{{ Storage::url("retur/$retur->retur_pict") }}" alt="">
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <p class="p-0 m-0">{{ $retur->sepatu->sepatu_name }} (DEFECT)</p>
                                                                <p class="p-0 m-0">Size : {{ $retur->sepatu->ukuran->ukuran_sepatu_nama }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <p>{{ formatCurrencyIDR($retur->retur_price) }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <p>{{ $c['qty'] }} pcs</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        @php
                                                            $total = $retur->retur_price * $c['qty'];
                                                            $subtotalProducts += $total;
                                                        @endphp
                                                        <p>{{ formatCurrencyIDR($total) }}</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="4">Your cart is empty!</td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <td colspan="3">
                                                <p class="text-right" style="font-weight: 500">SUBTOTAL PRODUCTS</p>
                                            </td>
                                            <td>
                                                <p style="font-weight: 500">{{ formatCurrencyIDR($subtotalProducts) }}</p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn px-2 gray_btn" id="cancel-button">
                                    Cancel
                                </button>
                                <button type="button" class="btn px-2 primary-btn" id="pay-button">
                                    Payment
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- </form> --}}
        </div>
    </section>
    <!--================End Checkout Area =================-->

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $transaction->snap_token }}', {
                onSuccess: function(result){
                    window.location.href = '{{ route('checkout-success', $transaction->htrans_penjualan_id) }}';
                },

                onPending: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result){
                    window.location.href = '{{ route('checkout-cancel', $transaction->htrans_penjualan_id) }}';
                }
            });
        };

        document.getElementById('cancel-button').onclick = function(){
            window.location.href = '{{ route('checkout-cancel', $transaction->htrans_penjualan_id) }}';
        }
    </script>

@endsection
