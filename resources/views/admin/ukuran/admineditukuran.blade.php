
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Master Ukuran</h3>
                <a href="/admin/ukuran" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditukuran',$IdUkuran->ukuran_sepatu_id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{$IdUkuran->ukuran_sepatu_nama}}"
                        placeholder="ukuran">
                        <span style="color: red;">{{ $errors->first('ukuran') }}</span>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection