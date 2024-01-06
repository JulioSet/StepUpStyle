
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Add Master Supplier</h3>
                <a href="/admin/supplier" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('addSupplier') }}" method="post"
                enctype="multipart/form-data" class="dropzone">
                @csrf
                <div class="mb-3">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Nama Supplier">
                    <span style="color: red;">{{ $errors->first('nama_supplier') }}</span>
                </div>

                <div class="mb-3">
                    <label for="supplier_contact" class="form-label">Supplier Contact</label>
                    <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" placeholder="Contact Supplier">
                    <span style="color: red;">{{ $errors->first('supplier_contact') }}</span>
                </div>

                <div class="mb-3">
                    <label for="supplier_office" class="form-label">Supplier Office</label>
                    <input type="text" class="form-control" id="supplier_office" name="supplier_office" placeholder="Office Supplier">
                    <span style="color: red;">{{ $errors->first('supplier_office') }}</span>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo" name="foto[]">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
