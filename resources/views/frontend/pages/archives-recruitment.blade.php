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
											<span>{{ trans('message.tuyen_dung') }}</span>
											<h2 style="display:none">{{ trans('message.tuyen_dung') }}</h2>
										</li>
									</ul>
								</div>
							</div>

							@include('frontend.components.breadcrumbs')
						</div>
					</div>
				</div>
			</div> <!--breadcrumbs-->
			<article class="art-recruitments recruitments">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="recruitments-content">
								<div class="recruitments-box recruitments-grid grid grid-3">
									@foreach ($data as $item)
										<div class="item">
											<div class="recruitment-box">
												<div class="recruitment-img">
													<div class="img">
														<img src="{{ $item->image }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}">
													</div>
												</div>
												<div class="recruitment-content">
													<div class="recruitment-name">
														<a href="{{ route('home.single-recruitment', ['slug' => $item->slug]) }}" title="recruitment" class="recruitment-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a>
													</div>
													<div class="recruitment-short-description">
														<ul>
															<li>{{ trans('message.muc_luong') }}: {{ number_format($item->salary_from, 0, '.', '.') }} - {{ number_format($item->salary_to, 0, '.', '.') }}</li>
															<li>{{ trans('message.dia_diem') }}: {{ app()->getLocale() == 'vi' ? $item->address : $item->address_en }}</li>
															<li>{{ trans('message.ngay_cap_nhat') }}: {{ $item->updated_at->format('d/m/Y') }}</li>
														</ul>
													</div>
													<div class="button recruitment-button">
														<a href="{{ route('home.single-recruitment', ['slug' => $item->slug]) }}" class="btn-read-more">{{ trans('message.chi_tiet') }}</a>
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
			</article> <!--end recruitments-->

			<article class="art-pagination">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							{{ $data->links('frontend.components.panigation') }}
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
			$('body').addClass('page-body tuyen-dung-body');
		});
	</script>
@endsection

