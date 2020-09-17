@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="contacts-site">
		<div class="main-container">
			<div class="breadcrumbs">
				<div class="breadcrumbs-image">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="breadcrumb-image">
									<img src="{{ @$dataSeo->banner }}" alt="banner">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="breadcrumbs-content" id="lien-he">
					<div class="container">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="breadcrumbs-box">
									<ul>
										<li>
											<a href="{{ url('/') }}" title="{{ trans('message.trang_chu') }}">{{ trans('message.trang_chu') }}</a>
										</li>
										<li class="final">
											<span>{{ trans('message.lien_he') }}</span>
											<h2 style="display:none">{{ trans('message.lien_he') }}</h2>
										</li>
									</ul>
								</div>
							</div>
	
							@include('frontend.components.breadcrumbs')
						</div>
					</div>
				</div>
			</div> <!--breadcrumbs-->
			<article class="art-contacts">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="contacts">
								<div class="contacts-title title-box">
									<h3 class="title">{{ trans('message.lien_he_voi_chung_toi') }}</h3>
									{!! @$content->title !!}
								</div>

								<div class="contact-information-box contacts-box">
									<ul>
										<li>
											<i class="fas fa-map-marker-alt icon icon-map"></i>
											<p>{{ app()->getLocale() == 'vi' ? @$site_info->address : @$site_info->address_en }}</p>
										</li>
										<li>
											<i class="fas fa-phone-alt icon icon-phone"></i>
											<p>{{ @$site_info->hotline }} - {{ @$site_info->hotline2 }}</p>
										</li>
										<li>
											<i class="fas fa-envelope icon icon-mail"></i>
											<p>{{ @$site_info->email }}</p>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="contacts-form">
								<div class="content">
									<div class="contact-title">
										<h3 class="title">{{ trans('message.nhap_thong_tin_cua_ban') }}</h3>
									</div>
									<form action="{{ route('home.post-contact') }}" method="POST" class="contact-form">	
										@csrf	
										<div class="row">
											@if (Session::has('flash_message'))
												<div class="col-sm-12">
													<div class="item" style="margin-bottom: 15px">
														<div class="alert alert-success alert-dismissible">
															<button type="button" class="close" data-dismiss="alert" style="font-size: 30px" aria-hidden="true">×</button>
															<h4><i class="fa fa-check"></i> Thông báo</h4>
															{{ Session::get('flash_message') }}
														</div>
													</div>
												</div>
											@endif		
										</div>
										<div class="form-group">
											<i class="fa fa-user icon name-icon" aria-hidden="true"></i>
											<input class="name-input form-control" type="text" name="name" value="{{ old('name') }}" placeholder="{{trans('message.ho_ten')}}">
											@if ($errors->has('name'))
												<span class="help-block">{{ $errors->first('name') }}</span>
											@endif
										</div>						
										<div class="form-group email-group">
											<i class="fas fa-envelope icon email-icon" aria-hidden="true"></i>
											<input class="email-input form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
											@if ($errors->has('email'))
												<span class="help-block">{{ $errors->first('email') }}</span>
											@endif
										</div>					
										<div class="form-group phone-group">
											<i class="fas fa-phone-alt icon phone-icon" aria-hidden="true"></i>
											<input class="phone-input form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="{{trans('message.so_dien_thoai')}}">
											@if ($errors->has('phone'))
												<span class="help-block">{{ $errors->first('phone') }}</span>
											@endif
										</div>					
										<div class="form-group map-group">
											<i class="fas fa-map-marker-alt icon map-icon" aria-hidden="true"></i>
											<input class="email-input form-control" type="text" name="address" value="{{ old('address') }}" placeholder="{{trans('message.dia_chi')}}">
											@if ($errors->has('address'))
												<span class="help-block">{{ $errors->first('address') }}</span>
											@endif
										</div>					
										<div class="form-group content-group">
											<i class="fa fa-pencil icon content-icon" aria-hidden="true"></i>
											<textarea class="content-input form-control" type="text" name="content" rows="6" placeholder="{{trans('message.noi_dung')}}">{!! old('content') !!}</textarea>
											@if ($errors->has('content'))
												<span class="help-block">{{ $errors->first('content') }}</span>
											@endif
										</div>
										<button type="submit" name="submit-send" class="btn send-btn">
											<span class="text">{{trans('message.gui')}}</span>
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>

			<article class="maps-contact">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="map-contact">
								<div id="map-container-google-2" class="z-depth-1-half map-container">
									{!! @$site_info->google_maps !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
	</div>
@stop
@if (request()->get('contactError'))
	@section('script')
		<script>
			$(document).ready(function () {
				$('html, body').animate({
					scrollTop: $("#lien-he").offset().top
				}, 1000);
			})
		</script>
	@endsection
@endif
@section('script')
	<script>
		$(document).ready(function($) {
			$('body').addClass('page-body lien-he-body');
		});
	</script>
@endsection
