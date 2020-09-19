@extends('frontend.master')
@section('main')
<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12" style="margin: auto">
	<div class="contacts-form">
		<div class="content">
			<div class="contact-title">
				<h3 class="title text-center">Xác nhận thay đổi mật khẩu</h3>
			</div>
			<div class="container">
				@if(Session::has('error_empty'))
					<div class="alert alert-error text-center" style="background: #fa7c7c;color: #000">
						{{ Session::get('error_empty') }}
					</div>
				@endif
				@if(Session::has('error'))
					<div class="alert alert-error text-center" style="background: #fa7c7c;color: #000">
						{{ Session::get('error') }}
					</div>
				@endif
			<form action="{{ route('home.new-password') }}" method="post">
				@csrf
				<input type="text" name="token" value="{{ $result->token }}" hidden="">
				Mật khẩu mới: <input type="password" value="{!! old('password') !!}" name="password" class="form-control">
				Nhập lại mật khẩu mới: <input type="password" value="{!! old('confirm') !!}" name="confirm" class="form-control">
				<button type="submit" class="btn btn-sm btn-danger btn-block">Xác nhận</button>
			</form>
		</div>
		</div>
	</div>
</div>
@endsection