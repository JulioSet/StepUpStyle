
@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Retur</h3>
            </div>
            <table id="myTable" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>From</th>
                        <th>Email</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listretur as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{ Storage::url("photo/$item->retur_foto") }}" alt="" width="350px"></td>
                        <td>{{ $item->sepatu->sepatu_name }}</td>
                        <td>{{ $item->user->user_name }}</td>
                        <td>{{ $item->user->user_email }}</td>
                        <td>{{ $item->retur_reason }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if($item->retur_status == 10) {{-- Canceled --}}
                            <a href="#" class="btn btn-danger">Canceled</a>
                            @else
                                @if($item->retur_status == 0) {{-- Pending --}}
                                <div class="d-flex">
                                    <a href="/admin/retur/accept/{{ $item->retur_id }}" class="btn btn-success mr-1">Accept</a>
                                    <a href="/admin/retur/reject/{{ $item->retur_id }}" class="btn btn-danger">Reject</a>
                                </div>
                                @else
                                    @if ($item->retur_status == -1) {{-- Rejected --}}
                                    <a href="#" class="btn btn-danger">Rejected</a>
                                    @else {{-- Accepted --}}
                                    <a href="/admin/retur/cancel/{{ $item->retur_id }}" class="btn btn-danger">Cancel</a>
                                    @endif
                                @endif
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
