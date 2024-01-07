@extends('laporan.layout.laporan')
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
