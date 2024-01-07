@extends('laporan.layout.laporan')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Detail Laporan Penjualan</h3>    
                <a  href="/laporan/penjualan" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            </form>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr >
                        <th>No</th>
                        <th>Nama Sepatu</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listdtrans as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->sepatu->sepatu_name}}</td>
                        <td>{{$item->sepatu->ukuran->ukuran_sepatu_nama}}</td>
                        <td>{{$item->dtrans_penjualan_qty}}</td>
                        <td>{{formatCurrencyIDR($item->dtrans_penjualan_price)}}</td>
                        <td>{{formatCurrencyIDR($item->dtrans_penjualan_subtotal)}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5">Grand Total</td>
                        <td>{{formatCurrencyIDR($item->htrans->htrans_penjualan_total)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection