@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Varian {{$sepatu->sepatu_name}}</h3>
                <a href="{{ route('viewAddVarianProduct', $sepatu->sepatu_id) }}" class="btn btn-primary ml-auto mb-1">Add</a>
                <a href="/admin/product" class="btn btn-danger ml-3 mb-1">Back</a>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Ukuran</th>
                        <th>Stock</th>
                        <th>Harga</th>
                        <th>Warna</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listvarian as $item)
                        @if ($item->deleted_at == null)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img src="{{ Storage::url("photo/$item->detail_sepatu_pict") }}" alt="" width="100%" ></td>
                            <td>{{$item->detail_sepatu_ukuran}}</td>
                            <td>{{$item->detail_sepatu_stok}}</td>
                            <td>{{ formatCurrencyIDR($item->detail_sepatu_harga) }}</td>
                            <td>{{$item->detail_sepatu_warna}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('viewEditVarianProduct', ['id'=>$item->fk_sepatu,'varian'=>$item->detail_sepatu_id])}}" class="btn btn-primary mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('unavailableVarianSepatu', ['id'=>$item->fk_sepatu,'varian'=>$item->detail_sepatu_id]) }}" class="btn btn-success">
                                        Available
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-black-50">{{$loop->iteration}}</td>
                            <td><img src="{{ Storage::url("photo/$item->detail_sepatu_pict") }}" alt="" width="100%" style="filter: grayscale(1); opacity: 0.6;"></td>
                            <td class="text-black-50">{{$item->detail_sepatu_ukuran}}</td>
                            <td class="text-black-50">{{$item->detail_sepatu_stok}}</td>
                            <td class="text-black-50">{{ formatCurrencyIDR($item->detail_sepatu_harga) }}</td>
                            <td class="text-black-50">{{$item->detail_sepatu_warna}}</td>
                            <td>
                                <a href="{{ route('availableVarianSepatu', ['id'=>$item->fk_sepatu,'varian'=>$item->detail_sepatu_id]) }}" class="btn btn-danger">
                                    Unavailable
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
