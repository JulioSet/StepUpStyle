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

<div class="d-flex container-fluid p-2">
    <h3 style="text-align: center">LAPORAN PRODUCT</h3>
</div>
<table id="myTable" class="table table-bordered">
    <thead>
        <tr >
            <th>No</th>
            <th>Product</th>
            <th>Color</th>
            <th>Size</th>
            <th>Stock</th>

        </tr>
    </thead>
    <tbody>
        @php $counter = 1; @endphp
        @foreach ($listproduct as $item)
            @foreach ($item->details as $detail)
            <tr>
                <td>{{$counter }}</td> 
                <td>{{$item->sepatu_name}}</td>
                <td>{{$detail->detail_sepatu_warna}}</td>
                <td>{{$detail->detail_sepatu_ukuran}}</td>
                <td>{{$detail->detail_sepatu_stok}}</td>
            </tr>
            @php $counter++; @endphp
            @endforeach
        @endforeach
    </tbody>
</table>