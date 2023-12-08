

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
                        <th>{{$loop->iteration}}</th>
                        <th><img src="{{ Storage::url("photo/$item->sepatu_pict") }}" alt="" width="100%" ></th>
                        <th>{{$item->sepatu_name}}</th>
                        <th>{{$item->supplier->supplier_name}}</th>
                        <th>{{$item->kategori->kategori_nama}}</th>
                        <th>{{$item->ukuran->ukuran_sepatu_nama}}</th>
                        <th>{{$item->sepatu_stock}}</th>
                        <th>{{$item->sepatu_price}}</th>
                        <th>{{$item->sepatu_color}}</th>
                        <th><a  href="#" class="btn btn-success mr-1">Edit</a><a  href="#" class="btn btn-danger">Delete</a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection