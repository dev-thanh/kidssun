@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="introduces-site">
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
				<div class="breadcrumbs-content">
					<div class="container">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="breadcrumbs-box">
									<ul>
										<li>
											<a href="{{ url('/') }}" title="{{ trans('message.trang_chu') }}">{{ trans('message.trang_chu') }}</a>
										</li>
										<li class="final">
											<span>{{ trans('message.ve_chung_toi') }}</span>
											<h2 style="display: none">{{ trans('message.ve_chung_toi') }}</h2>
										</li>
									</ul>
								</div>
							</div>

							@include('frontend.components.breadcrumbs')
						</div>
					</div>
				</div>
			</div> <!--breadcrumbs-->
			
			<article class="art-banners art-visions">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="banners-content visions-content">
								<div class="banners-box">
									<div class="item">
										<div class="banner-box">
											<div class="banner-content">
												<h4 class="title">{{ @$content->content_1->title }}</h4>
												<div class="short-description">
													{!! @$content->content_1->content !!}
												</div>
											</div>
											<div class="banner-img">
												<div class="img">
													<img src="{{ @$content->content_1->image }}" alt="{{ @$content->content_1->title }}" title="{{ @$content->content_1->title }}">
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

			<article class="art-banners art-mission">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="banners-content mission-content">
								<div class="title-box">
									<h3 class="title"><span>{{ trans('message.kids_sun') }}</span></h3>
								</div>

								<div class="banners-box">
									<div class="item">
										<div class="banner-box">
											<div class="banner-img">
												<div class="img">
													<img src="{{ @$content->content_2->image }}" alt="{{ @$content->content_2->title }}" title="{{ @$content->content_2->title }}">
												</div>
											</div>
											<div class="banner-content">
												<h4 class="title">{{ @$content->content_2->title }}</h4>
												<div class="short-description">
													{!! @$content->content_2->content !!}
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

			<article class="art-banners art-core-values">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="title-box core-values-title">
									<h3 class="title"><span>{{ trans('message.kids_sun') }}</span></h3>
								</div>

							<div class="banners-content core-values-content">
								<div class="banners-box">
									<div class="item">
										<div class="banner-box">
											<div class="banner-content">
												<h4 class="title">{{ @$content->content_3->title }}</h4>
												<div class="short-description">
													{!! @$content->content_3->content !!}
												</div>
											</div>
											<div class="banner-img">
												<div class="img">
													<img src="{{ @$content->content_3->image }}" alt="{{ @$content->content_3->title }}" title="{{ @$content->content_3->title }}">
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

			<article class="art-slider-introduces">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="slider-introduces-content">
								<div class="slider-introduces-box">
									<div class="slick-slider slick-introduces">
										@if (!empty(@$content->content_4->gallery))
											@foreach ($content->content_4->gallery as $item)
											<div class="item">
												<div class="introduce-box">
													<div class="introduce-image">
														<img src="{{ $item }}" title="{{ trans('message.kids_sun') }}" alt="introduce">
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
			</article> <!-- art-slidershow -->
		</div>
	</div>
@stop