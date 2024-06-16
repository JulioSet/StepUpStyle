<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
</style>
<h1 style="text-align: center" >LAPORAN PENJUALAN </h1>
<div class="detail-info">
    @foreach ($listhtrans as $item)
    <div style="display: flex; width: 100%" >
        <div class="col-2">
            <h5 class="p-2">ID</h5>
        </div>
        <div class="col-10">
            <h5 class="p-2">: {{$item->htrans_penjualan_id}}</h5>
        </div>
    </div>
    <div style="display: flex">
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
    
</div>
<table class="table table-bordered">
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
                <td>{{$item->detail->sepatu->sepatu_name}}</td>
                <td>{{$item->detail->ukuran_sepatu_nama}}</td>
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
@endforeach
