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
                                            @forelse ($listProducts as $dtrans)
                                                <li>{{ $dtrans->detail->sepatu->sepatu_name }} Size {{ $dtrans->detail->detail_sepatu_ukuran }}</li>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->
@endsection
