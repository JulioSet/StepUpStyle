
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Master User</h3>
                <a href="/admin/user" class="btn btn-danger ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditUser',$IdUser->user_id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$IdUser->user_name}}"
                        placeholder="Masukkan Nama">
                        <span style="color: red;">{{ $errors->first('nama') }}</span>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$IdUser->user_email}}"
                        placeholder="Masukkan Email">
                    <span style="color: red;">{{ $errors->first('email') }}</span>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{$IdUser->user_password}}"
                        placeholder="Masukkan Password">
                    <span style="color: red;">{{ $errors->first('password') }}</span>
                </div>

                <!-- Upload Foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto</label><br>
                    <input type="file" class="" id="foto" name="foto[]">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
