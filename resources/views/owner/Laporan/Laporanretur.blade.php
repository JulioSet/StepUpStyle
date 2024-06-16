@extends('owner.layout.laporan')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">

        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Laporan Retur</h3>
                <div class="ml-auto align-end">
                    <a href="{{route("viewPDFRetur")}}">
                        <button class="btn btn-primary"> PDF</button>
                    </a>
                </div>
            </div>
            <form action="{{route("filterR")}}" method="post" class="mb-3">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="startdate">Start Date</label>
                        <input type="date" class="form-control" name="startdate" id="startdate">
                        <span style="color: red;">{{ $errors->first('startdate') }}</span>
                    </div>
                    <div class="col-md-6">
                        <label for="enddate">End Date</label>
                        <input type="date" class="form-control" name="enddate" id="enddate">
                        <span style="color: red;">{{ $errors->first('enddate') }}</span>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>IMG</th>
                        <th>ID</th>
                        <th>Nama Sepatu</th>
                        <th>Harga Yang di Retur</th>
                        <th>Qty</th>
                        <th>Alasan</th>


                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($listretur as $item)
                    <?php
                        $namaFilePhotosJson = $item->retur_foto;
                        $namaFilePhotos = json_decode($namaFilePhotosJson, true);
                    ?>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @foreach ($namaFilePhotos as $photo)
                            <img class="p-2" src="{{ Storage::url('retur/' . $photo) }}" alt="" width="100%" height="100%">
                            @endforeach
                        </td>
                        <td>{{ $item->dtrans->htrans->htrans_penjualan_id }}</td>
                        <td>{{ $item->sepatu->sepatu_name }}</td>
                        <td>{{ $item->retur_price }}</td>
                        <td>{{ $item->retur_qty }}</td>
                        <td>{{ $item->retur_reason }}</td>
                    </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
