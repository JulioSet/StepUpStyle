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

<h1 style="text-align: center">LAPORAN PENJUALAN</h1>

<table id="myTable" class="table table-bordered">
    <thead>
        <tr >
            <th>No</th>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Transaction Date</th>
            <th>Sub Total</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($listhtrans as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->htrans_penjualan_id}}</td>
            <td>{{$item->customer->user_name}}</td>
            <td>{{$item->created_at->format('d M y')}}</td>
            <td>{{formatCurrencyIDR($item->htrans_penjualan_total)}}</td>

            <td class="align-middle">
                @if ($item->htrans_penjualan_status==1)
                    <button class=" btn genric-btn radius small btn-primary py-2">Belum Bayar</button>
                @elseif($item->htrans_penjualan_status==2)
                    <button class=" btn genric-btn radius small btn-success py-2">Lunas</button>
                @else
                    <button class=" btn genric-btn radius small btn-danger py-2">Cancel</button>
                @endif
            </td>
        @endforeach
    </tbody>
</table>