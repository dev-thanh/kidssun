@extends('frontend.master')
@section('main')
	<div class="breadcrumbs">
		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">


					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.tai_khoan_ngan_hang') }}</h1>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>



	<main class="main-site accounts-site">

		<div class="main-container">

			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
						@include('frontend.pages.product.side-nav-left')
					</div>

					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
						<article class="art-accounts art-bark">
							<div class="accounts-content">
								<form class="forms" method="POST" action="{{route('home.cap-nhap-tai-khoan-ngan-hang')}}">
									@csrf
									<div class="form-content">
										<div class="form-group">
											<label>{{ trans('message.ten_ngan_hang') }}</label>
											<input class="form-control" type="text" name="bank_name" placeholder="" value="{!! old('bank_name', @$member->bank_name) !!}">
											@if ($errors->has('bank_name'))
											<span class="error-message">{{ $errors->first('bank_name') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label>{{ trans('message.ten_chu_tai_khoan') }}</label>
											<input class="form-control" type="text" name="bank_account_name" placeholder="" value="{!! old('bank_account_name', @$member->bank_account_name) !!}">
											@if ($errors->has('bank_account_name'))
											<span class="error-message">{{ $errors->first('bank_account_name') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label>{{ trans('message.so_tai_khoan') }}</label>
											<input class="form-control" type="text" name="bank_account" placeholder="" value="{!! old('bank_account', @$member->bank_account) !!}">
											@if ($errors->has('bank_account'))
											<span class="error-message">{{ $errors->first('bank_account') }}</span>
											@endif
										</div>
										<div class="form-group">
											<label>{{ trans('message.dia_chi') }}</label>
											<textarea class="form-control" placeholder="" name="bank_address">{!! old('bank_address', @$member->bank_address) !!}</textarea>
											
										</div>											

										<div class="form-group">
											<div class="button">				
												<button class="btn">{{ trans('message.cap_nhap') }}</button>
											</div>
										</div>	
									</div>
								</form>
							</div>
						</article>
					</div>
				</div>
			</div>				

		</div>

	</main> <!--main-->
@stop