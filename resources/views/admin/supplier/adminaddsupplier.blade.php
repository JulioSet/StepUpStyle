
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
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
                </div>
        
                <div class="mb-3">
                    <label for="supplier_contact" class="form-label">Supplier Contact</label>
                    <input type="text" class="form-control" id="supplier_contact" name="supplier_contact">
                </div>
        
                <div class="mb-3">
                    <label for="supplier_office" class="form-label">Supplier Office</label>
                    <input type="text" class="form-control" id="supplier_office" name="supplier_office">
                </div>
        
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="logo" name="foto[]">
                </div>
        
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection