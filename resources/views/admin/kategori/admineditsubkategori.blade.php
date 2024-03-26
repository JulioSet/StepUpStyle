
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Sub Kategori</h3>
                <a href="/admin/kategori/{{$IdSubKategori->fk_kategori}}" class="btn btn-danger ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditSubkategori',['id'=>$IdSubKategori->fk_kategori,'sub'=>$IdSubKategori->subkategori_id]) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="sub_kategori" name="sub_kategori" class="form-label">Nama Sub Kategori</label>
                    <input type="text" class="form-control" id="sub_kategori" name="sub_kategori" placeholder="Nama Sub Kategori">
                    <span style="color: red;">{{ $errors->first('nama_sub_kategori') }}</span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
