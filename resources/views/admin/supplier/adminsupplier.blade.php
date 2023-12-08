
@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">
        
        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Supplier</h3>
                <a  href="/admin/addsupplier" class="btn btn-primary ml-auto mb-1">Add</a>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Nama Supplier</th>
                        <th>Supplier Contact</th>
                        <th>Supplier Office</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listsupplier as $item)
                        
                    
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <th><img src="{{ Storage::url("photo/$item->supplier_logo") }}" alt="" width="100%" ></th>
                        <th>{{$item->supplier_name}}</th>
                        <th>{{$item->supplier_contact}}</th>
                        <th>{{$item->supplier_office}}</th>
                        {{-- <th>{{$item->user_role}}</th> --}}
                        <th><a href=" " class="btn btn-success mr-1">Edit</a><a  href="#" class="btn btn-danger">Delete</a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection