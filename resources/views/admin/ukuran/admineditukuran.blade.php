
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Master Ukuran</h3>
                <a href="/adminukuran" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditukuran',$IdUkuran->ukuran_sepatu_id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <input type="number" class="form-control" id="ukuran" name="ukuran" value="{{$IdUkuran->ukuran_sepatu_nama}}"
                        placeholder="ukuran">
                </div>

                <div class="mb-3">
                    <label for="Stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="Stock" name="stock" value="{{$IdUkuran->ukuran_sepatu_stock}}"
                        placeholder="Stock">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection