@extends('layout.main')

@php
	use App\Models\sepatu;
@endphp

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Return Product</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/home">Home <span class="lnr lnr-arrow-right"></span></a>
                        <a href="/orders">Orders</a>
                        <a href="">Return Product Details</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-3">
                        <h3>Customer Details</h3>
                            <div class="col-md-12 form-group align-middle">
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ $userLoggedIn['name'] }}" readonly>
                            </div>
                            <div class="col-md-12 form-group align-middle">
                                <input type="text" class="form-control" id="email" name="email" value="{{ $userLoggedIn['email'] }}" readonly>
                            </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="order_details_table">
                            <h2>Return Details</h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        {{-- <tr>
                                            <th scope="col" colspan="2" class="">Product</th>
                                        </tr> --}}
                                        <tr>
                                            <td>
                                                Product
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="col-3">
                                                        <img class="img-fluid p-1" src="{{ Storage::url("retur/$namaFilePhotos[0]") }}" alt="">
                                                        <img class="img-fluid p-1" src="{{ Storage::url("retur/$namaFilePhotos[1]") }}" alt="">
                                                        <img class="img-fluid p-1" src="{{ Storage::url("retur/$namaFilePhotos[2]") }}" alt="">
                                                    </div>
                                                    <div class="flex-fill">
                                                        <h5>{{ $retur->dtrans->detail->sepatu->sepatu_name }}</h5>
                                                        <p>{{ $retur->dtrans->detail->detail_sepatu_ukuran }}</p>
                                                        <p>Qty: <strong>{{ $retur->retur_qty }}</strong></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Reason</td>
                                            <td>
                                                <p>{{ $retur->retur_reason }}</strong></p>
                                            </td>
                                        </tr>
                                        <tr></tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if ($retur->retur_status == 0)
                                                    <h6 class="genric-btn py-2 circle danger">Rejected</h6>
                                                @elseif ($retur->retur_status == 1)
                                                    <h6 class="genric-btn py-2 circle success">Accepted</h6>
                                                @elseif ($retur->retur_status == 2)
                                                    <h6 class="genric-btn py-2 circle primary">Pending</h6>
                                                @elseif ($retur->retur_status == 9)
                                                    <h6 class="genric-btn py-2 circle default">Cancelled</h6>
                                                @endif
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            @if ($retur->retur_status >= 9 || $retur->retur_status == 1)
                                <div class="d-flex justify-content-end">
                                    <a href="/orders" class="btn px-5 btn-dark">Back</a>
                                </div>
                            @else
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('cancel-retur', $retur->retur_id) }}" class="btn px-5 btn-danger">Cancel</a>
                                    <a href="/orders" class="btn px-5 btn-dark">Back</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <div style="color: red">{{ $err }}</div>
                @endforeach
            @endif
        </div>
        {{-- </div> --}}
    </section>

    <!--================End Checkout Area =================-->

@endsection
