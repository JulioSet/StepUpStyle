
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Add Master User</h3>
                <a href="/admin/user" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('Useraddadmin') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        placeholder="Masukkan Nama">
                    <span style="color: red;">{{ $errors->first('nama') }}</span>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Masukkan Email">
                    <span style="color: red;">{{ $errors->first('email') }}</span>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan Password">
                    <span style="color: red;">{{ $errors->first('password') }}</span>
                </div>

                <!-- Upload Foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto</label><br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto[]">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <span style="color: red;">{{ $errors->first('foto') }}</span>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
