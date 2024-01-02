@extends('layout.main')
@php
	use App\Models\sepatu;
	// $userLoggedIn = Session::get('userLoggedIn');
	// $listSepatu = sepatu::All();
@endphp
@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
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
                                {{-- <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th> --}}
                            </tr>
                        </thead>
                        {{-- @dd($cartSepatu) --}}
                        <tbody>
                            @php
                                $subtotalProducts = 0;
                            @endphp
                            @forelse ($cartSepatu as $c)
                                @php
                                    $sepatu = sepatu::find($c['id']);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex col-4">
                                                {{-- <img src="{{$c->pict}}" alt=""> --}}
                                                <img class="img-fluid" src="{{ Storage::url("photo/$sepatu->sepatu_pict") }}" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $sepatu->sepatu_name }}</h4>
                                                <h4>Size : {{ $sepatu->ukuran->ukuran_sepatu_nama }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ formatCurrencyIDR($sepatu->sepatu_price) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            {{-- @dump($c['id']) --}}
                                            <input type="text" name="qty" id="sst" maxlength="12" value="{{ $c['qty'] }}" title="Quantity:"
                                                class="input-text qty">
                                            <button class="increase items-count" type="button"><a href="/cart/up/{{$c['id']}}"><i class="lnr lnr-chevron-up"></i></a></button>
                                            <button class="reduced items-count" type="button"><a href="/cart/down/{{$c['id']}}"><i class="lnr lnr-chevron-down"></i></a></button>
                                            {{-- <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button> --}}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $total = $sepatu->sepatu_price * $c['qty'];
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
                            {{-- <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/cart.jpg" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>Minimalistic shop for multipurpose use</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>$360.00</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                            class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <h5>$720.00</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/cart.jpg" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>Minimalistic shop for multipurpose use</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>$360.00</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                            class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <h5>$720.00</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/cart.jpg" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>Minimalistic shop for multipurpose use</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>$360.00</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                            class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <h5>$720.00</h5>
                                </td>
                            </tr> --}}
                            {{-- <tr class="bottom_button">
                                <td>
                                    <a class="gray_btn" href="#">Update Cart</a>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" placeholder="Coupon Code">
                                        <a class="primary-btn" href="#">Apply</a>
                                        <a class="gray_btn" href="#">Close Coupon</a>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h4>{{ formatCurrencyIDR($subtotalProducts) }}</h4>
                                </td>
                            </tr>
                            {{-- <tr class="shipping_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li><a href="#">Flat Rate: $5.00</a></li>
                                            <li><a href="#">Free Shipping</a></li>
                                            <li><a href="#">Flat Rate: $10.00</a></li>
                                            <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                        </ul>
                                        <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                        <select class="shipping_select">
                                            <option value="1">Bangladesh</option>
                                            <option value="2">India</option>
                                            <option value="4">Pakistan</option>
                                        </select>
                                        <select class="shipping_select">
                                            <option value="1">Select a State</option>
                                            <option value="2">Select a State</option>
                                            <option value="4">Select a State</option>
                                        </select>
                                        <input type="text" placeholder="Postcode/Zipcode">
                                        <a class="gray_btn" href="#">Update Details</a>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr class="out_button_area">
                                <td colspan="4"></td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="/products">Continue Shopping</a>
                                        <a class="primary-btn" href="#">Proceed to checkout</a>
                                    </div>
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
