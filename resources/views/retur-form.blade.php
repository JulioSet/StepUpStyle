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
                        <a href="">Return Product</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <form action=" {{ route('submit-retur') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                            <div class="order_box">

                                <h2>Product Details</h2>
                                <div class="d-flex form-group align-middle">
                                    <h5 class="pt-2 col-3">Name <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <input type="text" class="form-control flex-fill" id="name" name="name" placeholder="{{ $sepatu->sepatu_name }}" readonly>
                                </div>
                                <div class="d-flex form-group align-middle">
                                    <h5 class="pt-2 col-3">Size <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <input type="text" class="form-control flex-fill" id="size" name="size" placeholder="{{ $detailSepatu->detail_sepatu_ukuran }}" readonly>
                                </div>
                                <div class="d-flex form-group align-middle mb-1">
                                    <h5 class="pt-2 col-3">Qty <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <div class="product_count m-0 mt-2">
                                        {{-- <input type="number" name="qty" max="{{ $tempRetur['dtrans_penjualan_qty'] }}" min=1 value="{{ $tempRetur['dtrans_penjualan_qty'] }}" title="Quantity:" class="input-text qty"> --}}
                                        <input type="number" name="qty" value={{ $dtrans->dtrans_penjualan_qty }} class="input-text qty" min="1" max="{{ $dtrans->dtrans_penjualan_qty }}">
                                    </div>
                                </div>
                                <span  style="color: red; margin-left: 26%;">{{ $errors->first('qty') }}</span>
                                
                                <div class="d-flex form-group align-middle mb-1 mt-2">
                                    <h5 class="pt-2 col-3">Reason <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <textarea class="form-control flex-fill" name="reason" id="reason" cols="30" rows="5"></textarea><br>
                                </div>
                                <span  style="color: red; margin-left: 26%;">{{ $errors->first('reason') }}</span>
                                
                                <div class="d-flex form-group align-middle mb-1 mt-2">
                                    <h5 class="pt-2 col-3">Product Picture <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <input type="file" class="form-control flex-fill" id="product" name="product[]" placeholder="">
                                </div>
                                <span style="color: red; margin-left: 26%;" >{{ $errors->first('product') }}</span>

                                <div class="d-flex form-group align-middle mb-1 mt-2">
                                    <h5 class="pt-2 col-3">Product Picture <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <input type="file" class="form-control flex-fill" id="product" name="product1[]" placeholder="">
                                </div>
                                <span style="color: red; margin-left: 26%;" >{{ $errors->first('product1') }}</span>

                                <div class="d-flex form-group align-middle mb-1 mt-2">
                                    <h5 class="pt-2 col-3">Product Picture <span class="text-danger">*</span></h5>
                                    <h5 class="pt-2 d-flex mr-1">:</h5>
                                    <input type="file" class="form-control flex-fill" id="product" name="product2[]" placeholder="">
                                </div>
                                <span style="color: red; margin-left: 26%;" >{{ $errors->first('product2') }}</span>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn px-2 primary-btn" data-toggle="modal" data-target="#notifModal">
                                        Request Return
                                    </button>
                                </div>

                                {{-- <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="notifModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Notification</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Request Retur Success!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <div style="color: red">{{ $err }}</div>
                @endforeach
            @endif --}}
        </div>
        {{-- </div> --}}
    </section>

    <!--================End Checkout Area =================-->

@endsection
