
@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Master Kategori</h3>
                <a href="/admin/kategori/add" class="btn btn-primary ml-auto mb-1">Add</a>
            </div>
            <table id="myTable" class="table table-bordered table-clickable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listkategori as $item)
                    <tr data-href="/admin/kategori/{{$item->kategori_id}}" style="cursor: pointer">
                        @if ($item->deleted_at == null)
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kategori_nama}}</td>
                        <td>
                            <a href="{{route('viewEditKategori',$item->kategori_id)}}" class="btn btn-primary mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                            <a href="/admin/kategori/unavailable/{{$item->kategori_id}}" class="btn btn-success">Available</a>
                        </td>
                        @else
                        <td class="text-black-50">{{$loop->iteration}}</td>
                        <td class="text-black-50">{{$item->kategori_nama}}</td>
                        <td>
                            <a href="/admin/kategori/available/{{$item->kategori_id}}" class="btn btn-danger">Unavailable</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const tableRows = document.querySelectorAll(".table-clickable tbody tr");
    for (const tableRow of tableRows) {
        tableRow.addEventListener("click", function () {
            // window.open(this.dataset.href, "_blank");
            window.location.href = this.dataset.href;
        });
    }
</script>
@endsection
