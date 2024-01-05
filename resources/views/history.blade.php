@extends('layout.main')

@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Order Tracking</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/orders">Order Tracking</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area section_gap">
        <div class="container">
            <div class="order_box">
                <h2>Orders History</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center col-1">Order ID</th>
                                <th class="text-center col-2">Date</th>
                                <th class="text-center flex-fill">Products</th>
                                <th class="text-center col-2">Total</th>
                                <th class="text-center col-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td class="align-middle">
                                        <h5 class="text-center">{{ $item->htrans_penjualan_id }}</h5>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-center">{{ $item->created_at }}</p>
                                    </td>

                                    <td>
                                        @php
                                            $listProducts = $item->dtrans()->get();
                                        @endphp
                                        <ul>
                                            @forelse ($listProducts as $p)
                                                <li>{{ $p->sepatu->sepatu_name }} Size {{ $p->sepatu->ukuran->ukuran_sepatu_nama }}</li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </td>

                                    <td class="align-middle">
                                        <p class="text-center">{{ formatCurrencyIDR($item->htrans_penjualan_total) }}</p>
                                    </td>

                                    <td class="align-middle">
                                        @if ($item->htrans_penjualan_status == 0)
                                            <a href="{{ route('checkout-details', $item->htrans_penjualan_id) }}" class="genric-btn radius small danger py-2" style="font-size: 1em; line-height: 15px">Cancelled</a>
                                        @elseif ($item->htrans_penjualan_status == 1)
                                            <a href="{{ route('checkout-details', $item->htrans_penjualan_id) }}" class="genric-btn radius small primary py-2" style="font-size: 1em; line-height: 15px">Waiting for Payment</a>
                                        @elseif ($item->htrans_penjualan_status == 2)
                                            <a href="{{ route('checkout-details', $item->htrans_penjualan_id) }}" class="genric-btn radius small info py-2" style="font-size: 1em; line-height: 15px">Waiting for Pick Up</a>
                                        @elseif ($item->htrans_penjualan_status == 3)
                                            <a href="{{ route('checkout-details', $item->htrans_penjualan_id) }}" class="genric-btn radius small btn-success py-2" style="font-size: 1em; line-height: 15px">Success</a>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">You don't have any orders yet</td>
                                </tr>
                            @endforelse

                            {{-- <tr>
                                <td colspan="3">
                                    <p class="text-right" style="font-weight: 500">SUBTOTAL PRODUCTS</p>
                                </td>
                                <td>
                                    <p style="font-weight: 500">{{ formatCurrencyIDR($subtotalProducts) }}</p>
                                </td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>

                {{-- <div class="d-flex justify-content-end">
                    <button type="button" class="btn px-2 grey_btn" id="cancel-button">
                        Cancel
                    </button>
                    <button type="button" class="btn px-2 primary-btn" id="pay-button">
                        Payment
                    </button>
                </div> --}}
            </div>
            {{-- <div class="tracking_box_inner">
                <p>To track your order please enter your Order ID in the box below and press the "Track" button. This
                    was given to you on your receipt and in the confirmation email you should have received.</p>
                <form class="row tracking_form" action="#" method="post" novalidate="novalidate">
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" id="order" name="order" placeholder="Order ID" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Order ID'">
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Billing Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Billing Email Address'">
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="primary-btn">Track Order</button>
                    </div>
                </form>
            </div> --}}
        </div>
    </section>
    <!--================End Tracking Box Area =================-->
@endsection
