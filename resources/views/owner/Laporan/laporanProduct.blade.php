@extends('owner.layout.laporan')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Laporan Product</h3>
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
                    @foreach ($listproduct as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->sepatu_name}}</td>
                        <td>{{$item->sepatu_color}}</td>
                        <td>{{$item->detail->detail_sepatu_stok}}</td>
                        <td>{{$item->sepatu_stock}}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
