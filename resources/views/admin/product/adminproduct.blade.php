

@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">
        
        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Product</h3>
                <a  href="/adminaddproduct" class="btn btn-primary ml-auto mb-1">Add</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Sepatu</th>
                        <th>Harga</th>
                        <th>Warna</th>
                        <th>Gambar</th>
                        <th>Brand</th>
                        <th>Kategori</th>
                        <th>Ukuran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($listuser as $item)
                        
                    
                    <tr>
                        <th>{{$item->user_id}}</th>
                        <th>{{$item->user_name}}</th>
                        <th>{{$item->user_email}}</th>
                        <th>{{$item->user_profile}}</th>
                        <th>{{$item->user_role}}</th>
                        <th><a  href="#" class="btn btn-success mr-1">Edit</a><a  href="#" class="btn btn-danger">Delete</a></th>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection