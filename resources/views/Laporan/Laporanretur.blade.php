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
                    <tr>
                        <th>No</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listhtrans as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
