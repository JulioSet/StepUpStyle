@extends('owner.layout.laporan')
@section('content')
<div class="col-md-12 mt-2">

    <div class="card container-fluid">
        
        
        <div class="card-body w-100 ">
            <div class="d-flex container-fluid p-2">
                <h3>Laporan Penjualan</h3>
            </div>
            <form action="{{route("filter")}}" method="post" class="mb-3">
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

            <div class="container card-body px-4 mx-auto">
                <div class="p-6 m-20 bg-white rounded shadow">
                    <div class="card-body">
                    {!! $chart->container() !!}
                    </div>
                </div>
            
            </div>
    
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr >
                        <th>No</th>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Transaction Date</th>
                        <th>Sub Total</th>
                        <th>Status</th>
                        <th>Detail</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($listhtrans as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->htrans_penjualan_id}}</td>
                        <td>{{$item->customer->user_name}}</td>
                        <td>{{$item->created_at->format('d M y')}}</td>
                        <td>{{formatCurrencyIDR($item->htrans_penjualan_total)}}</td>

                        <td class="align-middle">
                            @if ($item->htrans_penjualan_status==1)
                                <button class=" btn genric-btn radius small btn-primary py-2">Belum Bayar</button>
                            @elseif($item->htrans_penjualan_status==2)
                                <button class=" btn genric-btn radius small btn-success py-2">Lunas</button>
                            @else
                                <button class=" btn genric-btn radius small btn-danger py-2">Cancel</button>
                            @endif
                        </td>
                        <td>
                            <a href="{{route("detail",$item->htrans_penjualan_id)}}" class="btn btn-primary mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1z"/>
                                </svg>
                            </a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endsection
