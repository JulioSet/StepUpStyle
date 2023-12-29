
@extends('admin.layout.admin')
@section('content')
<div class="col-md-12 mt-2">
    <h3>Notification</h3>
    @foreach ($listnotif as $notif)
    <div class="card">
        <div class="card-body">
            <h5 class="card-text">{{ $notif['content'] }}</h5>
            <p class="card-text text-black-50 text-sm-end">{{ $notif['diff'] }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
