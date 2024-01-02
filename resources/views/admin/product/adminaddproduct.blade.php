
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Add Master Product</h3>
                <a href="/admin/product" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('addSepatu') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="namaSepatu" class="form-label">Nama Sepatu</label>
                    <input type="text" class="form-control" id="namaSepatu" name="namaSepatu" placeholder="Masukkan Nama Sepatu">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga">
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Masukkan Harga">
                </div>


                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="foto[]">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>

                <!-- Ukuran -->
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <select class="form-control" id="ukuran" name="ukuran">
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <!-- Tambahkan opsi ukuran lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Warna (Combobox) -->
                <div class="mb-3">
                    <label for="warna" class="form-label">Warna</label>
                    <select class="form-control" id="warna" name="warna">
                        <option value="Merah">Merah</option>
                        <option value="Biru">Biru</option>
                        <option value="Hijau">Hijau</option>
                        <!-- Tambahkan opsi warna lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Brand -->
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <select class="form-control" id="brand" name="brand">

                        @foreach ($listsupplier as $item)
                        <option value="{{$item->supplier_name}}">{{$item->supplier_name}}</option>
                        @endforeach
                        <!-- Tambahkan opsi brand lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">

                        @foreach ($listkategori as $item)
                        <option value="{{$item->kategori_nama}}">{{$item->kategori_nama}}</option>
                        @endforeach
                        <!-- Tambahkan opsi brand lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
