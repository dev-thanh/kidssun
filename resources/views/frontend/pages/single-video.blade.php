@extends('frontend.master')
@section('main')
    <div class="blogs-details-site">
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
                                        <li>
											<a href="{{ route('home.video') }}" title="{{ trans('message.video') }}">{{ trans('message.video') }}</a>
										</li>
                                        <li class="final">
                                            <span>{{ trans('message.chi_tiet_video') }}</span>
                                            <h2 style="display:none">{{ trans('message.chi_tiet_video') }}</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @include('frontend.components.breadcrumbs')
                        </div>
                    </div>
                </div>
            </div> <!--breadcrumbs-->
            <article class="art-banners images">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
							<article class="blogs-details">
								<div class="blogs-details-content">
									<div class="title-box blogs-details-title">
										<h1 class="title"><span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h1>

										<div class="blog-date-created">
											<!-- <i class="fal fa-clock icon date-icon" aria-hidden="true"></i> -->
											<span>{{ $data->created_at->format('d/m/Y') }}</span>
										</div>

										<div class="blog-detail-short-description">
											{!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}
										</div>
									</div>
									<div class="blog-detail-box">
										<div class="content">
											<div class="video">
												{!! $data->iframe_video !!}
											</div>
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
                                                                    <img src="{{ $item->image }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="blog-content">
                                                            <div class="blog-name">
                                                                <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" class="blog-link" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
                                                                    {{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
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
													<a href="{{ @$site_info->side_bar->video->link }}" title="{{ @$site_info->side_bar->video->title }}">
                                                        <img src="{{ @$site_info->side_bar->video->banner }}" alt="{{ @$site_info->side_bar->video->title }}">
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
            </article> <!--end banners-->
        </div>
    </div>
@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.image-video').addClass('active');
		});
	</script>
@endsection