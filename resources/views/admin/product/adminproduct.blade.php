

@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Product</h3>
                <a  href="/admin/addproduct" class="btn btn-primary ml-auto mb-1">Add</a>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Sepatu</th>
                        <th>Nama Supplier</th>
                        <th>Kategori</th>
                        <th>Ukuran</th>
                        <th>Stock</th>
                        <th>Harga</th>
                        <th>Warna</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listproduk as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{ Storage::url("photo/$item->sepatu_pict") }}" alt="" width="100%" ></td>
                        <td>{{$item->sepatu_name}}</td>
                        <td>{{$item->supplier->supplier_name}}</td>
                        <td>{{$item->kategori->kategori_nama}}</td>
                        <td>{{$item->ukuran->ukuran_sepatu_nama}}</td>
                        <td>{{$item->sepatu_stock}}</td>
                        <td>{{$item->sepatu_price}}</td>
                        <td>{{$item->sepatu_color}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary mr-3">Edit</a>
                                <a href="#" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
