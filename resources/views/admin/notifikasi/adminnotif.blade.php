
@extends('admin.layout.admin')
@section('header')
<div>
    <div class="d-flex">
        <h3>Notification</h3>
        <a href="/admin/clear" class="btn btn-info ml-auto">Clear notification</a>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs pt-2">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#order">
                Order
                @if($unread_order > 0)
                    <span class="badge badge-danger">{{$unread_order}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#retur">
                Retur
                @if($unread_retur > 0)
                    <span class="badge badge-danger">{{$unread_retur}}</span>
                @endif
            </a>
        </li>
    </ul>

</div>
@endsection
@section('content')
<div class="col-md-12">
    <!-- Tab panes -->
    <div class="tab-content">
        <div id="order" class="container tab-pane active"><br>
            @forelse ($listnotif_order as $notif)
                <div class="card" style="cursor: pointer" onclick="window.location.href='/admin/order'">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="w-100">
                                <h5 class="card-text">{{ $notif['content'] }}</h5>
                                <p class="card-text text-black-50 text-sm-end">{{ $notif['diff'] }}</p>
                            </div>
                            <a href="/admin/clear/{{$notif['id']}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <h4 class="text-center text-secondary">There is no notification!</h4>
            @endforelse
        </div>
        <div id="retur" class="container tab-pane fade"><br>
            @forelse ($listnotif_retur as $notif)
                <div class="card" style="cursor: pointer" onclick="window.location.href='/admin/retur'">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="w-100">
                                <h5 class="card-text">{{ $notif['content'] }}</h5>
                                <p class="card-text text-black-50 text-sm-end">{{ $notif['diff'] }}</p>
                            </div>
                            <a href="/admin/clear/{{$notif['id']}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <h4 class="text-center text-secondary">There is no notification!</h4>
            @endforelse
        </div>
    </div>
</div>
@endsection
