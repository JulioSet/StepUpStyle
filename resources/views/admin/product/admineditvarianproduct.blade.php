
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Edit Varian {{$varian->sepatu->sepatu_name}}</h3>
                <a href="{{route('viewVarianProduct', ['id' => $varian->fk_sepatu])}}" class="btn btn-danger ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('EditVarianProduct',['id'=>$varian->fk_sepatu,'varian'=>$varian->detail_sepatu_id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="foto[]">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>

                <!-- Warna (Combobox) -->
                <div class="mb-3">
                    <label for="warna" class="form-label">Warna</label>
                    <select class="form-control" id="warna" name="warna">
                        <option hidden>Pilih Warna</option>
                        <option value="Hitam">Hitam</option>
                        <option value="Putih">Putih</option>
                        <option value="Merah">Merah</option>
                        <option value="Biru">Biru</option>
                        <option value="Hijau">Hijau</option>
                        <option value="Kuning">Kuning</option>
                        <!-- Tambahkan opsi warna lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Ukuran -->
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Masukkan Ukuran">
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Masukkan Stok">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
