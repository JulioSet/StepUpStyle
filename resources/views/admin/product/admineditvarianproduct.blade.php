
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
                        <input type="file" class="custom-file-input" id="gambar" name="foto" value="{{$varian->sepatu->details->first()->detail_sepatu_pict}}">
                        <label class="custom-file-label" for="exampleInputFile">{{$varian->sepatu->details->first()->detail_sepatu_pict}}"</label>
                        <span style="color: red;">{{ $errors->first('foto') }}</span>
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
                        <option value="Orange">Orange</option>
                        <option value="Cream">Cream</option>
                        <!-- Tambahkan opsi warna lainnya sesuai kebutuhan -->
                    </select>
                </div>

                <!-- Ukuran -->
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="Masukkan Ukuran" value="{{$varian->sepatu->details->first()->detail_sepatu_ukuran}}">
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Masukkan Stok" value="{{$varian->sepatu->details->first()->detail_sepatu_stok}}">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" value="{{$varian->sepatu->details->first()->detail_sepatu_harga}}">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        var cleave = new Cleave('#harga', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        $('#gambar').on('change',function(e){
            if (e.target.files.length) {
                $(this).next('.custom-file-label').html(e.target.files[0].name);
            }
        })
    </script>
@endsection
