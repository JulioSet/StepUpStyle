@extends('layout.main')

@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Profile</h1>
					<nav class="d-flex align-items-center">
						<a href="/home">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="/profile">Profile</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

    @php
        $userLoggedIn = Session::get('userLoggedIn');
    @endphp

    <section class="login_box_area section_gap">
		<div class="container">
			<div class="row">

				<div class="col-lg-6" style="height:70vh">
					<div class="login_form_inner">
						<h3>INI BUAT PROFILE PICT USER</h3>
					</div>
				</div>

				<div class="col-lg-6" style="height:110vh">
					<div class="login_form_inner">
						<h3>Profile</h3>
						<form class="row login_form" action="{{ route('user-register') }}" method="post" id="register">
							@csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" value="{{ $userLoggedIn['name'] }}" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
								<br><span style="color: red;">{{ $errors->first('name') }}</span>
							</div>	
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" value="{{ $userLoggedIn['email'] }}" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
								<br><span style="color: red;">{{ $errors->first('email') }}</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
								<br><span style="color: red;">{{ $errors->first('password') }}</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
								<br><span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
							</div>

							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Edit</button>
							</div>
						</form>
						@if (Session::has('msg'))
							<div style="color: red">
								<span>{{ Session::get('msg'); }}</span>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection