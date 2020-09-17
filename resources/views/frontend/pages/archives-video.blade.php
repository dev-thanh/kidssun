@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<div class="videos-site">
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
                                            <span>{{ trans('message.video') }}</span>
                                            <h2 style="display:none">{{ trans('message.video') }}</h2>
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="banners-content">
                                <ul class="banners-box videos-grid grid grid-3">
                                    @foreach ($data as $item)
                                        <li class="item">
                                            <div class="banner-box">
                                                <div class="banner-image">
                                                    <a href="{{ route('home.single-video', ['slug' => $item->slug]) }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
														<img src="{{ $item->image }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></a>
                                                </div>
                                                <div class="banner-content">
                                                    <div class="banner-name">
                                                        <a href="{{ route('home.single-video', ['slug' => $item->slug]) }}" class="banner-link" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{ $data->links('frontend.components.panigation-1') }}
                        </div>
                    </div>
                </div>
            </article> <!--end banners-->
        </div>
    </div>
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('.image-video').addClass('active');
		});
        $(document).ready(function($) {
			$('body').addClass('page-body video-body');
		});
	</script>
@endsection
