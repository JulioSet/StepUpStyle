
@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Supplier</h3>
                <a  href="/admin/supplier/add" class="btn btn-primary ml-auto mb-1">Add</a>
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
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{ Storage::url("photo/$item->supplier_logo") }}" alt="" width="100%" ></td>
                        <td>{{$item->supplier_name}}</td>
                        <td>{{$item->supplier_contact}}</td>
                        <td>{{$item->supplier_office}}</td>
                        <td>
                            <a href="{{route('viewEditSupplier',$item->supplier_id)}}" class="btn btn-primary mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                            <a href="/admin/supplier/delete/{{$item->supplier_id}}" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
