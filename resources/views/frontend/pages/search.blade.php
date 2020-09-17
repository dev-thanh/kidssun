@extends('frontend.master')
@section('main')
	<section id="banner">
		<div class="avarta avarta-home"><img src="{{ url('/') }}/images/bn-local.png" class="img-fluid" width="100%" alt="banner"></div>
		<div class="caption-banner">
			<div class="container">
				<div class="content">
					<h1>{{ strtoupper(trans('message.villar_home_stay')) }}</h1>
					<div class="search-banner">
						<div class="info-search">
							<h2>{{ trans('message.tim_kiem_tu_khoa') }}: {{ request()->get('q') }}</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="local">
		<div class="container">
			<div class="content">
				<div class="list-local">
					<div class="row">
						@if (count($data))
							@foreach ($data as $item)
								<div class="col-md-4 col-sm-4">
									<div class="item">
										<div class="avarta"><a href="{{ route('home.single-tour', ['slug' => $item->slug]) }}"><img src="{{ $item->image }}" class="img-fluid" width="100%" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></a></div>
										<div class="info">
											<h3><a href="{{ route('home.single-tour', ['slug' => $item->slug]) }}">{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</a></h3>
											<p>{{ app()->getLocale() == 'vi' ? $item->place : $item->place_en }}</p>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="col-sm-12">
								<div class="alert alert-success" role="alert">
									{{ trans('message.khong_tim_thay_noi_nao_phu_hop') }}
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>

@stop