
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Master Kategori</h3>
                <a href="/admin/kategori" class="btn btn-danger ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditkategori',$IdKategori->kategori_id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori">
                    <span style="color: red;">{{ $errors->first('nama_kategori') }}</span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
