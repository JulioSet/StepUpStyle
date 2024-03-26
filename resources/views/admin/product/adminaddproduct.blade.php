
@extends('admin.layout.admin')
@section('content')

<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Add Master Product</h3>
                <a href="/admin/product" class="btn btn-danger ml-auto mb-1">Back</a>
            </div>
            <form action="{{ route('addSepatu') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="namaSepatu" class="form-label">Nama Sepatu</label>
                    <input type="text" class="form-control" id="namaSepatu" name="namaSepatu" placeholder="Masukkan Nama Sepatu">
                </div>

                <!-- Brand -->
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <select class="form-control" id="brand" name="brand">
                        <option hidden>Select Brand</option>
                        @foreach ($listsupplier as $item)
                            <option value="{{$item->supplier_id}}">{{$item->supplier_name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">
                        <option hidden>Select Category</option>
                        @foreach ($listkategori as $item)
                            <option value="{{$item->kategori_id}}">{{$item->kategori_nama}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Sub Kategori --}}
                <div class="mb-3">
                    <label for="kategori" class="form-label">Sub Kategori</label>
                    <select class="form-control" id="sub_kategori" name="sub_kategori">
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
          $('#kategori').on('change', function() {
            var categoryId = $(this).val();

            $.ajax({
              url: '/get-sub-items/' + categoryId,
              success: function(data) {
                $('#sub_kategori').empty(); // Clear existing options
                $.each(data, function(key, subkategori) {
                  $('#sub_kategori').append('<option value="' + subkategori.id + '">' + subkategori.nama + '</option>');
                });
              }
            });
          });
        });
    </script>
@endsection
