@extends('layout.main')
@php
	use App\Models\sepatu;
    use App\Models\DetailSepatu;
@endphp
@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
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
                        {{-- @dd($cartSepatu) --}}
                        <tbody>
                            @php
                                $subtotalProducts = 0;
                            @endphp
                            @forelse ($cartSepatu as $c)
                                @php
                                    $sepatu = DetailSepatu::find($c['detail_id']);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex col-4">
                                                @if ($sepatu->detail_sepatu_pict != null)
                                                    <img class="img-fluid" src="{{ Storage::url("photo/$sepatu->detail_sepatu_pict") }}" alt="">
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $sepatu->sepatu->sepatu_name }}</h4>
                                                <h5>Size : {{ $sepatu->detail_sepatu_ukuran }}</h4>
                                                <h5>Color : {{ $sepatu->detail_sepatu_warna }}</h4>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ formatCurrencyIDR($sepatu->detail_sepatu_harga) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="qty" id="sst" maxlength="12" value="{{ $c['qty'] }}" title="Quantity:"
                                                class="input-text qty">
                                            <button class="increase items-count" type="button"><a href="{{ route('increase-cart-qty', $c['detail_id']) }}"><i class="lnr lnr-chevron-up"></i></a></button>
                                            <button class="reduced items-count" type="button"><a href="{{ route('reduced-cart-qty', $c['detail_id']) }}"><i class="lnr lnr-chevron-down"></i></a></button>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                             $total = $sepatu->detail_sepatu_harga * $c['qty'];
                                            $subtotalProducts += $total;
                                        @endphp
                                        <h5>{{ formatCurrencyIDR($total) }}</h5>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Your cart is empty!</td>
                                </tr>
                            @endforelse

                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h4>{{ formatCurrencyIDR($subtotalProducts) }}</h4>
                                </td>
                            </tr>

                            <tr class="out_button_area">
                                <td colspan="4"></td>
                                <td>
                                    <form action="{{ route('checkout-process') }}" method="POST">
                                        @csrf
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <a class="gray_btn" style="padding: 0px 13px" href="/products">Continue Shopping</a>
                                            @if ($cartSepatu != NULL)
                                                <button class="btn primary-btn">Checkout</button>
                                            @else
                                                <button class="btn primary-btn" disabled>Checkout</button>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

@endsection
