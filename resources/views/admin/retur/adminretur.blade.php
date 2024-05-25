
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
                        <th>Foto</th>
                        <th>Name</th>
                        <th>From</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listretur as $item)
                    <?php
                        $namaFilePhotosJson = $item->retur_foto;
                        $namaFilePhotos = json_decode($namaFilePhotosJson, true);
                    ?>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>@foreach ($namaFilePhotos as $items)
                        <img class="p-2" src="{{ Storage::url("retur/$items") }}" alt="" width="40%" height="40%" >
                        @endforeach</td>
                        <td>{{ $item->sepatu->sepatu_name }}</td>
                        <td>{{ $item->user->user_email }}</td>
                        <td>{{ $item->retur_reason }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            @if($item->retur_status == 9) {{-- Canceled --}}
                            <button class="btn btn-warning">Canceled</button>
                            @else
                                @if($item->retur_status == 2) {{-- Pending --}}
                                <div class="d-flex">
                                    <a href="/admin/retur/accept/{{ $item->retur_id }}" class="btn btn-success mr-1">Accept</a>
                                    <a href="/admin/retur/reject/{{ $item->retur_id }}" class="btn btn-danger">Reject</a>
                                </div>
                                @else
                                    @if ($item->retur_status == 0) {{-- Rejected --}}
                                    <button class="btn btn-danger">Rejected</button>
                                    @else {{-- Accepted --}}
                                    {{-- <a href="/admin/retur/cancel/{{ $item->retur_id }}" class="btn btn-danger">Accepted</a> --}}
                                    <a href="#" class="btn btn-success">Accepted</a>
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
