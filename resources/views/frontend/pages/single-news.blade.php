@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="blogs-details-site">
		<div class="main-container">
			<div class="breadcrumbs">
				<div class="breadcrumbs-image">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="breadcrumb-image">
									<img src="{{ @$dataSeo->banner }}" alt="breadcrumb">
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
										<li>
											<a href="{{ route('home.news') }}" title="{{ trans('message.tin_tuc') }}">{{ trans('message.tin_tuc') }}</a>
										</li>
										<li class="final">
											<span>{{ trans('message.chi_tiet_tin_tuc') }}</span>
											<h2 style="display:none">{{ trans('message.chi_tiet_tin_tuc') }}</h2>
										</li>
									</ul>
								</div>
							</div>
	
							@include('frontend.components.breadcrumbs')
						</div>
					</div>
				</div>
			</div> <!--breadcrumbs-->
			<div class="container">
				<div class="row">
					<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
						<article class="blogs-details">
							<div class="blogs-details-content">
								<div class="title-box blogs-details-title">
									<h1 class="title"><span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h1>

									<div class="blog-date-created">
										<span>{{ $data->created_at->format('d/m/Y') }}</span>
									</div>

									<div class="blog-detail-short-description">
										<p>
											{{ app()->getLocale() == 'vi' ? $data->desc : $data->desc_en }}
										</p>
									</div>
								</div>
								<div class="blog-detail-box">
									<div class="content">
										<div class="blog-detail-description">
											{!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}
										</div>
									</div>
								</div>
							</div>
						</article> <!--end blogs-->

						<article class="art-comments">
							<div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
						</article>

						<article class="art-blogs related-blogs">
							<div class="blogs-content">
								<div class="title-box related-blogs-title">
									<h3 class="title"><span>{{ trans('message.bai_viet_lien_quan') }}</span></h3>
								</div>

								<div class="related-blogs-box">
									<div class="slick-slider slick-related-blogs">
										@foreach ($news_same as $item)
											<div class="item">
												<div class="blog-box">
													<div class="blog-img">
														<div class="img">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}">
																<img src="{{ $item->image }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></a>
														</div>
													</div>
													<div class="blog-content">
														<div class="blog-name">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" title="Blog" class="blog-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
														</div>
														<div class="blog-date-created">
															<?php 
																$now = \Carbon\Carbon::now();
																$created_at = $item->created_at;
																$time = $created_at->diffForHumans($now);
															?>
															<span>{{ $time }} - {{ $item->Author->name }}</span>
														</div>
														<div class="blog-short-description">
															<p>{{ app()->getLocale() == 'vi' ? $item->desc : $item->desc_en }}</p>
														</div>
														<div class="button blog-button">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" class="btn-read-more">{{ trans('message.chi_tiet') }}</a>
														</div>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</article> <!--end blogs-->
					</div>

					<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
						<aside class="asi-sidebar">
							<div class="sidebar-box sidebar-blogs">
								<div class="sidebar-title sidebar-blogs-title">
									<h3 class="title">
										<span>{{ trans('message.tin_tuc_moi_nhat') }}</span>
									</h3>
								</div>
								<div class="sidebar-blogs-box">
									<ul>
										@foreach ($news as $item)
											<li class="item">
												<div class="blog-box">
													<div class="blog-img">
														<div class="img">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}">
																<img src="{{ $item->image }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></a>
														</div>
													</div>
													<div class="blog-content">
														<div class="blog-name">
															<a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" class="blog-link" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
														</div>
														<div class="blog-date-created">
															<i class="fal fa-clock icon date-icon" aria-hidden="true"></i>
															<span>{{ $item->created_at->format('d/m/Y') }}</span>
														</div>
													</div>
												</div>
											</li>
										@endforeach
									</ul>
								</div>
							</div>

							<div class="sidebar-box sidebar-banner">
								<div class="sidebar-banner-box">
									<div class="banner-box">
										<div class="banner-img">
											<div class="img">
												<a href="{{ @$site_info->side_bar->news->link_1 }}" title="{{ @$site_info->side_bar->news->title_1 }}">
													<img src="{{ @$site_info->side_bar->news->banner_1 }}" alt="{{ @$site_info->side_bar->news->title_1 }}">
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="sidebar-box sidebar-banner">
								<div class="sidebar-banner-box">
									<div class="banner-box">
										<div class="banner-img">
											<div class="img">
												<a href="{{ @$site_info->side_bar->news->link_2 }}" title="{{ @$site_info->side_bar->news->title_2 }}">
													<img src="{{ @$site_info->side_bar->news->banner_2 }}" alt="{{ @$site_info->side_bar->news->title_2 }}">
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('.page-blog').addClass('active');
		});
		$(document).ready(function($) {
			$('body').addClass('page-body chi-tiet-tin-tuc-body');
		});
	</script>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=1620283888101801&autoLogAppEvents=1"></script>
@endsection