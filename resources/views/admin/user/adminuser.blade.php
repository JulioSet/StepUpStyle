
@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master User</h3>
                <a  href="/admin/adduser" class="btn btn-primary ml-auto mb-1">Add</a>
            </div>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Profil</th>
                        <th>Username</th>
                        <th>Email</th>
                        {{-- <th>Role</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listuser as $item)


                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{ Storage::url("photo/$item->user_profil") }}" alt="" width="100%" ></td>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->user_email}}</td>
                        <td>
                            <a href="{{route('viewEditUser',$item->user_id)}} " class="btn btn-primary mr-3">Edit</a>
                            @if ($item->deleted_at == null)
                            <a href="#" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                                    <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2"/>
                                </svg>
                            </a>
                            @else
                            <a href="#" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
                                </svg>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
