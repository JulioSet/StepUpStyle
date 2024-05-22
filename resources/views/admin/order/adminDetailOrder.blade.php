@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Detail Order</h3>
                <a  href="/admin/order" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            </form>
            <div class="detail-info">
                @foreach ($listhtrans as $item)
                <div class="row">
                    <div class="col-2">
                        <h5 class="p-2">ID</h5>
                    </div>
                    <div class="col-10">
                        <h5 class="p-2">: {{$item->htrans_penjualan_id}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <h5 class="p-2">Customer</h5>
                    </div>
                    <div class="col-10">
                        <h5 class="p-2">: {{$item->customer->user_name}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <h5 class="p-2">Transaction Date</h5>
                    </div>
                    <div class="col-10">
                        <h5 class="p-2">: {{$item->created_at->format('d M Y')}}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sepatu</th>
                        <th>Ukuran</th>
                        <th>Color</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listdtrans as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->detail->sepatu->sepatu_name}}</td>
                        <td>{{$item->detail->detail_sepatu_ukuran}}</td>
                        <td>{{$item->detail->detail_sepatu_warna}}</td>
                        <td>{{$item->dtrans_penjualan_qty}}</td>
                        <td>{{formatCurrencyIDR($item->dtrans_penjualan_price)}}</td>
                        <td>{{formatCurrencyIDR($item->dtrans_penjualan_subtotal)}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"><b>Grand Total</b></td>
                        <td><b>{{formatCurrencyIDR($item->htrans->htrans_penjualan_total)}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
