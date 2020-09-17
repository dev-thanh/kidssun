@extends('frontend.master')
@section('main')
    <?php if(!empty($dataSeo)){
        $content = json_decode($dataSeo->content);
    } ?>
    <div class="recruitments-site">
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
                                            <span>{{ trans('message.tin_tuc') }}</span>
                                            <h2 style="display:none">{{ trans('message.tin_tuc') }}</h2>
										</li>
									</ul>
								</div>
							</div>

							@include('frontend.components.breadcrumbs')
						</div>
					</div>
				</div>
			</div> <!--breadcrumbs-->
			<article class="art-blogs blogs">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="blogs-content">
                                <div class="blogs-box blogs-grid grid grid-3">
                                    @foreach ($data as $item)
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
                                                    <div class="button blog-button">
                                                        <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" class="btn-read-more" title="{{ trans('message.chi_tiet') }}">{{ trans('message.chi_tiet') }}</a>
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
            </article> <!--end blogs-->

            <article class="art-pagination">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            {{ $data->links('frontend.components.panigation') }}
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="pagination-number">
                                <?php
                                    $data = $data->toArray();
                                ?>
                                <p>{{ trans('message.hien_thi') }} {{ $data['to'] }} {{ trans('message.tren') }} {{ $data['total'] }} {{ trans('message.bai_viet') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
		</div>
	</div>
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('body').addClass('page-body tin-tuc-body');
		});
	</script>
@endsection