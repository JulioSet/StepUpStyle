
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Master Supplier</h3>
                <a href="/admin/supplier" class="btn btn-danger ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditsupplier',$IdSupplier->supplier_id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="gambar" class="form-label">Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="foto">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <span style="color: red;">{{ $errors->first('foto') }}</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{$IdSupplier->supplier_name}}">
                    <span style="color: red;">{{ $errors->first('nama_supplier') }}</span>
                </div>

                <div class="mb-3">
                    <label for="supplier_contact" class="form-label">Supplier Contact</label>
                    <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" value="{{$IdSupplier->supplier_contact}}">
                    <span style="color: red;">{{ $errors->first('supplier_contact') }}</span>
                </div>

                <div class="mb-3">
                    <label for="supplier_office" class="form-label">Supplier Office</label>
                    <input type="text" class="form-control" id="supplier_office" name="supplier_office" value="{{$IdSupplier->supplier_office}}">
                    <span style="color: red;">{{ $errors->first('supplier_office') }}</span>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="logo" name="foto[]">
                        {{-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                    </div>
                    @if (session('error'))
                        <span style="color: red;">{{ session('error') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>

    <script>
        $('#gambar').on('change',function(e){
            if (e.target.files.length) {
                $(this).next('.custom-file-label').html(e.target.files[0].name);
            }
        })
    </script>
@endsection
