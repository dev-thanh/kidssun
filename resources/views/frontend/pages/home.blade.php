<?php $magioithieu = request()->get('ma-gioi-thieu') ? request()->get('ma-gioi-thieu') : ''; ?>
@extends('frontend.master')
@section('main')
	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
	} ?>
	<div class="home-site">
		<div class="main-container">
			<article class="art-slidershow">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="slidershow-content">
								<div class="slidershow-box">
									<div class="slick-slider slick-slidershow">
										@foreach ($slider as $item)
											<div class="item">
												<div class="slide-box">
													<div class="slide-image">
														<img src="{{ $item->image }}" alt="{{ $item->name }}" title="{{ $item->name }}">
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article> <!-- art-slidershow -->
			<h2 style="display: none">{{ @$content->about->title }}</h2>
			<article class="art-banners art-introduces">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="banners-content">
								<div class="title-box banners-title">
									<h1 class="title">{{ trans('message.kids_sun') }}</h1>
									<h3 class="title"><span>{{ @$content->about->title }}</span></h3>
								</div>

								<div class="banners-box">
									<div class="item">
										<div class="banner-box">
											<div class="banner-content">
												<div class="short-description">
													<p>{{ @$content->desc }}</p>
												</div>
												<div class="button banner-button">
													<a href="{{ route('home.about') }}" title="{{ trans('message.tim_hieu_them') }}" class="btn btn-read-more">
														<span>{{ trans('message.tim_hieu_them') }} <i class="fal fa-angle-right icon icon-right"></i></span>
													</a>
												</div>
											</div>
											<div class="banner-img">
												<div class="img">
													<img src="{{ @$content->about->image }}" alt="banner">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article> <!--end banners-->

			<article class="art-banners art-services">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="banners-content">
								<div class="banners-box">
									@if (!empty(@$content->service->list))
										@foreach ($content->service->list as $item)
											<div class="item">
												<div class="banner-box">
													<div class="banner-img">
														<div class="img">
															<img src="{{ $item->icon }}" alt="{{ $item->title }}" title="{{ $item->title }}">
														</div>
													</div>
													<div class="banner-content">
														<h4>{{ $item->title }}</h4>
													</div>
												</div>
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</article> <!--end banners-->

			<article class="art-blogs">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="blogs-content">
								<div class="title-box blogs-title">
									<h3 class="title"><span>{{ trans('message.tin_tuc_noi_bat') }}</span></h3>
								</div>

								<div class="blogs-box girls-bg boy-bg">
									<div class="slick-slider slick-blogs">
										@foreach ($posts_hot as $item)
											<div class="item">
												<div class="blog-box">
													<div class="blog-img">
														<div class="img">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}"><img src="{{ $item->image }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></a>
														</div>
													</div>
													<div class="blog-content">
														<div class="blog-name">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" class="blog-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
														</div>
														<div class="blog-short-description">
															@include('frontend.components.blog-short-description')
														</div>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article> <!--end blogs-->

			<article class="art-testimonials">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="testimonials-content">
								<div class="title-box testimonials-title">
									<h3 class="title"><span>{{ trans('message.y_kien_khach_hang') }}</span></h3>
								</div>

								<div class="testimonials-box">
									<div class="slick-slider slick-testimonials">
										@if(!empty(@$content->opinion->list))
											@foreach ($content->opinion->list as $item)
												<div class="item">
													<div class="testimonial-box">
														<div class="testimonial-content">
															<div class="avata">
																<img src="{{ $item->image }}" alt="{{ $item->name }}" title="{{ $item->name }}">
															</div>
															<div class="author-office">
																<span class="author">{{ $item->name }}</span>
															</div>
														</div>
														<div class="testimonial-comment">
															<div class="comment">
																{!! $item->content !!}
															</div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article> <!--end testimonials-->

			<article class="art-brands">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="brands-content">
								<div class="title-box brands-title">
									<h3 class="title"><span>{{ trans('message.doi_tac') }}</span></h3>
								</div>

								<div class="brands-box">
									<div class="slick-slider slick-brands">
										@foreach ($partner as $item)
											<div class="item">
												<div class="brand-box">
													<div class="brand-image">
														<a href="{{ $item->link }}" title="{{ $item->name }}">
															<img src="{{ $item->image }}" alt="{{ $item->name }}">
														</a>														
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article> <!-- art-brands -->
		</div>
	</div>
	
    @if(request()->get('login') && !Auth::guard('customer')->check())
    	<script type="text/javascript">
    		$(document).ready(function($) {
    			$('.popup-content-registration').removeClass('active');
	            $('.popup-content-login').addClass('active');
	            $('.art-popups-login-registration').addClass('active');
    		})
    	</script>
    @endif
	@if($magioithieu && $magioithieu !='')
	<script type="text/javascript">
		$(document).ready(function($) {
			$('.popups-content > div').removeClass('active');
			$('.popup-content-registration').addClass('active');
			$('.art-popups-login-registration').addClass('active');
		});
	</script>
	@endif
@endsection