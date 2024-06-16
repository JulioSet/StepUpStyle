<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
</style>

<h1 style="text-align: center">LAPORAN RETUR</h1>
<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            {{-- <th>IMG</th> --}}
            <th>ID</th>
            <th>Nama Sepatu</th>
            <th>Harga Yang di Retur</th>
            <th>Qty</th>
            <th>Alasan</th>


        </tr>
    </thead>
    <tbody>
        
        
        <tr>
            @foreach ($listretur as $item)
        <?php
            $namaFilePhotosJson = $item->retur_foto;
            $namaFilePhotos = json_decode($namaFilePhotosJson, true);
        ?>
            <td>{{ $loop->iteration }}</td>
            {{-- <td>
                @foreach ($namaFilePhotos as $photo)
                <img class="p-2" src="{{ Storage::url('retur/' . $photo) }}" alt="" width="100%" height="100%">
                @endforeach
            </td> --}}
            <td>{{ $item->dtrans->htrans->htrans_penjualan_id }}</td>
            <td>{{ $item->sepatu->sepatu_name }}</td>
            <td>{{ $item->retur_price }}</td>
            <td>{{ $item->retur_qty }}</td>
            <td>{{ $item->retur_reason }}</td>
        </tr>
        @endforeach
        
        
    </tbody>
</table>