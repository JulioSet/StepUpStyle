@extends('owner.layout.laporan')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Laporan Product</h3>
                <div class="ml-auto align-end">
                    <a href="{{route("viewPDFProduk")}}">
                        <button class="btn btn-primary"> PDF</button>
                    </a>
                </div>
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
        </div>
    </div>
</div>
@endsection
