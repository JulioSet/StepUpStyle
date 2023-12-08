

@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">
        
        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Ukuran</h3>
                <a  href="/admin/addukuran" class="btn btn-primary ml-auto mb-1">Add</a>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ukuran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listukuran as $item)
                        
                    
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <th>{{$item->ukuran_sepatu_nama}}</th>
                        <th><a href="{{route('viewEditUkuran',$item->ukuran_sepatu_id)}}" class="btn btn-success mr-1">Edit</a><a  href="#" class="btn btn-danger">Delete</a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection