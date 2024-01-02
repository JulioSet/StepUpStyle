
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Master Product</h3>
                <a href="/admin/product" class="btn btn-primary ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('AdminEditProduct',$IdProduct->sepatu_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="namaSepatu" class="form-label">Nama Sepatu</label>
                    <input type="text" class="form-control" id="namaSepatu" name="namaSepatu" placeholder="Masukkan Nama Sepatu" value="{{$IdProduct->sepatu_name}}">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" value="{{$IdProduct->sepatu_price}}">
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Harga" value="{{$IdProduct->sepatu_stock}}">
                </div>
                <!-- Ukuran -->
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <select class="form-control" id="ukuran" name="ukuran">
                        @foreach ($listukuran as $item)
                        <option value="{{$item->ukuran_sepatu_nama}}" {{ $IdProduct->ukuran->ukuran_sepatu_nama == $item->ukuran_sepatu_nama ? 'selected' : '' }}>{{$item->ukuran_sepatu_nama}}</option>
                        @endforeach
                        <!-- Tambahkan opsi ukuran lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Warna (Combobox) -->
                <div class="mb-3">
                    <label for="warna" class="form-label">Warna</label>
                    <select class="form-control" id="warna" name="warna">
                        <option value="Merah" {{ $IdProduct->sepatu_color == "Merah" ? 'selected' : '' }}>Merah</option>
                        <option value="Biru" {{ $IdProduct->sepatu_color == "Biru" ? 'selected' : '' }}>Biru</option>
                        <option value="Hijau" {{ $IdProduct->sepatu_color == "Hijau" ? 'selected' : '' }}>Hijau</option>
                        <!-- Tambahkan opsi warna lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Brand -->
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <select class="form-control" id="brand" name="brand">

                        @foreach ($listsupplier as $item)
                        <option value="{{$item->supplier_name}}" {{ $IdProduct->supplier->supplier_name == $item->supplier_name ? 'selected' : '' }}>{{$item->supplier_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">

                        @foreach ($listkategori as $item)
                        <option value="{{$item->kategori_nama}}" {{ $IdProduct->kategori->kategori_nama == $item->kategori_nama ? 'selected' : '' }}>{{$item->kategori_nama}}</option>
                        @endforeach
                        <!-- Tambahkan opsi brand lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="foto[]">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
