@extends('frontend.master')
@section('main')
	<?php if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>
	<h2 style="display:none">{{ trans('message.tuyen_dung') }}</h2>
	<div class="recruitments-details-site">
		<div class="main-container">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<article class="blogs-details">
							<div class="blogs-details-content">
								<div class="title-box blogs-details-title recruitments-details-title">
									<h1 class="title"><span>{{ app()->getLocale() == 'vi' ? $data->name : $data->name_en }}</span></h1>

									<div class="blog-detail-other-info">
										<ul>
											<li class="wage">
												<span>{{ trans('message.muc_luong') }}: {{ number_format($data->salary_from, 0, '.', '.') }} - {{ number_format($data->salary_to, 0, '.', '.') }}</span>
											</li>
											<li class="work-location">
												<span>{{ trans('message.dia_diem_lam_viec') }}: {{ app()->getLocale() == 'vi' ? $data->address : $data->address_en }}</span>
											</li>
											<li class="date-created">
												<span>{{ trans('message.ngay_cap_nhat') }}: {{ $data->updated_at->format('d/m/Y') }}</span>
											</li>
										</ul>
									</div>
								</div>
								<div class="blog-detail-box recruitment-detail-box">
									<div class="content">											
										<div class="blog-detail-description recruitment-detail-description">
											{!! app()->getLocale() == 'vi' ? $data->content : $data->content_en !!}
										</div>

										<div class="blog-detail-contact" id="ung-tuyen">
											<h3 class="title">{{ trans('message.lien_he') }}</h3>
											<div class="contacts-form">
												<div class="content">
													<div class="contact-title">
														<h4 class="title">{{ trans('message.nop_don_ung_tuyen') }}</h4>
													</div>
													<form action="{{ route('home.post-recruitment') }}" method="POST" enctype="multipart/form-data" class="contact-form">
														@csrf
														<div class="row">
															@if (Session::has('flash_message'))
																<div class="col-sm-12">
																	<div class="item" style="margin-bottom: 15px">
																		<div class="alert alert-success alert-dismissible">
																			<button type="button" class="close" data-dismiss="alert" style="font-size: 30px" aria-hidden="true">×</button>
																			<h4><i class="fa fa-check"></i> {{ trans('message.thong_bao') }}</h4>
																			{{ Session::get('flash_message') }}
																		</div>
																	</div>
																</div>
															@endif		
														</div>			
														<div class="form-group">
															<span>{{ trans('message.ho_ten') }}</span>
															<input class="name-input form-control" type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('message.ho_ten') }}">
															@if ($errors->has('name'))
																<span class="help-block">{{ $errors->first('name') }}</span>
															@endif
														</div>							
														<div class="form-group phone-group">
															<span>{{trans('message.so_dien_thoai')}}</span>
															<input class="phone-input form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="{{trans('message.so_dien_thoai')}}">
															@if ($errors->has('phone'))
																<span class="help-block">{{ $errors->first('phone') }}</span>
															@endif
														</div>				
														<div class="form-group email-group">
															<span>{{trans('message.email')}}</span>
															<input class="email-input form-control" type="text" name="email" value="{{ old('email') }}" placeholder="{{trans('message.email')}}">
															@if ($errors->has('email'))
																<span class="help-block">{{ $errors->first('email') }}</span>
															@endif
														</div>	
														<div class="button form-button" style="clear: both;">
															<div class="fr-button">
																<input type="file" name="fileCV" id="fileCV">
																<button type="file" name="file-upload" class="btn file-upload-btn">
																	<i class="fa fa-pencil icon content-icon" aria-hidden="true"></i>
																	<span class="text">{{trans('message.dinh_kem_cv')}}</span>
																</button>
																@if ($errors->has('fileCV'))
																	<span class="help-block">{{ $errors->first('fileCV') }}</span>
																@endif	
															</div>

															<div class="fr-button">
																<button type="submit" name="submit-send" class="btn send-btn">
																	<input type="hidden" name="id" value="{{ $data->id }}">
																	<span class="text">{{trans('message.gui')}}</span>
																</button>	
															</div>															
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</article> <!--end blogs-->

						<article class="others-position">
							<div class="others-position-content">
								<div class="title-box others-position-title">
									<h3 class="title"><span>{{ trans('message.vi_tri_dang_tuyen_dung_khac') }}</span></h3>
								</div>

								<div class="others-position-box">
									@foreach ($recruitment_same as $item)
										<div class="item">	
											<div class="other-position-box">
												<h4 class="title"><span>{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</span></h4>

												<div class="other-position-info">
													<ul>
														<li class="wage">
															<span>{{ trans('message.muc_luong') }}: {{ number_format($item->salary_from, 0, '.', '.') }} - {{ number_format($item->salary_to, 0, '.', '.') }}</span>
														</li>
														<li class="work-location">
															<span>{{ trans('message.dia_diem_lam_viec') }}: {{ app()->getLocale() == 'vi' ? $item->address : $item->address_en }}</span>
														</li>
														<li class="date-created">
															<span>{{ trans('message.ngay_cap_nhat') }}: {{ $item->updated_at->format('d/m/Y') }}</span>
														</li>
													</ul>
												</div>

												<div class="button other-position-button">
													<a href="{{ route('home.single-recruitment', ['slug' => $item->slug]) }}" class="btn-read-more">
														{{ trans('message.chi_tiet') }} <i class="fal fa-angle-right icon icon-right"></i>
													</a>
												</div>
											</div>							
										</div>
									@endforeach
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
	<script>
		$(document).ready(function($) {
			$('.page-recruitment').addClass('active');
		});
		$(document).ready(function($) {
			$('body').addClass('recruitments-details-body');
		});
	</script>
@endsection
@if (count($errors) > 0)
	@section('script')
		<script>
			$(document).ready(function (event) {
				event.preventDefault();
				$('html, body').animate({
					scrollTop: $("#ung-tuyen").offset().top
				}, 1000);
			})
		</script>
	@endsection
@endif