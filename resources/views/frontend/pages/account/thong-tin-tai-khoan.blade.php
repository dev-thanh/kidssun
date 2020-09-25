<?php $tab = request()->get('tab') ? request()->get('tab') : ''; ?>
@extends('frontend.master')
@section('main')
	<div class="breadcrumbs">
		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">


					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.thong_tin_tai_khoan') }}</h1>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<main class="main-site accounts-site">

		<div class="main-container">

			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
						@include('frontend.pages.product.side-nav-left')
					</div>

					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
						<article class="art-accounts">
							<div class="accounts-box">
								<div class="title-box title-accounts">
									<div class="tab-title">
										<ul>
											<li>
												<a href="#" class="information-title @if($tab =='tttk' || $tab =='') active @endif">{{ trans('message.thong_tin_tai_khoan') }}</a>
											</li>
											<li>
												<a href="#" class="password-title @if($tab =='tdmk') active @endif">{{ trans('message.mat_khau') }}</a>
											</li>
											<li>
												<a href="#" style="border-right-width: 1px" class="url-title @if($tab =='urlgt') active @endif">{{ trans('message.url_gioi_thieu') }}</a>
											</li>
											<input type="hidden" class="current-url" value="{{route('home.thong-tin-tai-khoan')}}">
										</ul>
									</div>
								</div>
							</div>

							<div class="accounts-content" style="position: relative">
								@if($member->xac_nhan ==0)
									<span style="position: absolute;top: 0px;width: 100%;text-align: center;left: 0px;color:red">{{ trans('message.chua_xac_nhan') }}</span>
								@endif
								<div class="information-box @if($tab =='tttk' || $tab =='') active @endif">
									<form class="forms" method="POST" id="cap_nhap_thong_tin" action="{{route('home.cap-nhap-tai-khoan')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-content">
											<input type="hidden" name="member_id" value="{{$member->id}}">
											<div class="form-group">
												<label>{{ trans('message.ho_ten') }}</label>
												<input class="form-control" type="text" name="full_name" placeholder="" value="{!! old('full_name', @$member->full_name) !!}">
												
												<span class="error-message error_full_name"></span>
												
											</div>	
											<div class="form-group form-no-input">
												<label>{{ trans('message.ten_truy_cap') }}</label>
												<input class="form-control" value="{{$member->user_name}}" type="text" name="user_name" placeholder="">
												
											</div>	
											<div class="form-group">
												<label>Email</label>
												<input class="form-control" value="{!! old('email', @$member->email) !!}" type="text" name="email" placeholder="">
												
												<span class="error-message error_email"></span>
												
											</div>	
											<div class="form-group">
												<label>{{ trans('message.so_dien_thoai') }}</label>
												<input class="form-control" type="text" value="{!! old('phone', @$member->phone) !!}" name="phone" placeholder="">
												
												<span class="error-message error_phone"></span>
												
											</div>

											<div class="form-group">
												<label>{{ trans('message.so_cmt') }}</label>
												<input class="form-control" type="number" value="{!! old('so_cmnd', @$member->so_cmnd) !!}" name="so_cmnd" placeholder="">
												
												<span class="error-message error_so_cmnd"></span>
												
											</div>	

											<div class="form-group-control">
												<input type="hidden" name="cmnd1_key" value="{{$member->cmnd1}}">
												<input type="hidden" name="cmnd2_key" value="{{$member->cmnd2}}">
												@if($member->cmnd1 !='')
												<div class="form-group">
													<div class="preview">
													  	<img style="margin: unset" src="{{url('/')}}/public/images/{{$member->id}}_{{$member->cmnd1}}" alt="Bil chuyển tiền" class="preview-img">
													  	
														</br><span class="error-message error_cmnd1"></span>
														
													</div>
													<div class="form-img">
														<input type="file" name="cmnd1" id="fileToUpload1">
														<span class="btn">Ảnh CMT 01</span>
													</div>
													
												</div>
												@else
												<div class="form-group">
													<div class="preview">
													  	<img style="margin: unset" src="http://dev.gcosoftware.vn/viettrung/images/img-bill.png" alt="Bil chuyển tiền" class="preview-img">
													  	
															</br><span class="error-message error_cmnd1"></span>
														
													</div>
													<div class="form-img">
														<input type="file" name="cmnd1" id="fileToUpload1">
														<span class="btn">Ảnh CMT 01</span>
													</div>
													
												</div>
												@endif

												@if($member->cmnd2 !='')
												<div class="form-group">
													<div class="preview">
													  	<img style="margin: unset" src="{{url('/')}}/public/images/{{$member->id}}_{{$member->cmnd2}}" alt="Bil chuyển tiền" class="preview-img">
													  	
															</br><span class="error-message error_cmnd2"></span></br>
														
													</div>
													<div class="form-img">
														<input type="file" name="cmnd2" id="fileToUpload2">
														<span class="btn">Ảnh CMT 02</span>
													</div>
													
												</div>
												@else
												<div class="form-group">
													<div class="preview">
													  	<img style="margin: unset" src="http://dev.gcosoftware.vn/viettrung/images/img-bill.png" alt="Bil chuyển tiền" class="preview-img">
													  	
															</br><span class="error-message error_cmnd2"></span></br>
														
													</div>
													<div class="form-img">
														<input type="file" name="cmnd2" id="fileToUpload2">
														<span class="btn">Ảnh CMT 02</span>
													</div>
													
												</div>
												@endif
											</div>
											<div>
												
																					
											</div>

											<div class="form-group">
												<div class="button">				
													<button class="btn btn-cap-nhap-thong-tin">{{ trans('message.cap_nhap') }}</button>
												</div>
											</div>	
										</div>
									</form>
								</div>

								<div class="password-box @if($tab =='tdmk') active @endif">
									<form class="forms" action="{{route('home.cap-nhap-mat-khau')}}" id="thay_doi_mat_khau" method="POST">
										@csrf
										<div class="form-content">
											<div class="form-group">
												<label>{{ trans('message.mat_khau_cu') }}</label>
												<input class="form-control" type="text" name="old_password" placeholder="">
												</br><span class="error-message error_old_password"></span>
											</div>
											<div class="form-group">
												<label>{{ trans('message.mat_khau_moi') }}</label>
												<input class="form-control" type="text" name="new_password" placeholder="">
												</br><span class="error-message error_new_password"></span>
											</div>
											<div class="form-group">
												<label>{{ trans('message.nhap_lai_mat_khau_moi') }}</label>
												<input class="form-control" type="text" name="renew_password" placeholder="">
												</br><span class="error-message error_renew_password"></span>
											</div>											

											<div class="form-group">
												<div class="button">				
													<button class="btn btn-thay-doi-mat-khau">{{ trans('message.cap_nhap') }}</button>
												</div>
											</div>	
										</div>
									</form>
								</div>

								<div class="url-box @if($tab =='urlgt') active @endif">
									<ul>
										<li>
											<a id="divClipboard-page" href="{{route('home.index',['ma-gioi-thieu'=>$member->link_aff])}}">{{route('home.index',['ma-gioi-thieu'=>$member->link_aff])}}</a>
											<a href="" class="btn btn-copy"  onclick="copyClipboard_Code('divClipboard-page');">Copy</a>
										</li>
									</ul>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>				

		</div>

	</main> <!--main-->
	<script type="text/javascript">		
		function copyClipboard_Code($id) {
			event.preventDefault();
			var elm = document.getElementById($id);
			$('.btn-copy').html('Copied');
			setTimeout(function(){
			 $('.btn-copy').html('Copy'); },
			1000);
			if(window.getSelection) {
			    var selection = window.getSelection();
			    var range = document.createRange();
			    range.selectNodeContents(elm);
			    selection.removeAllRanges();
			    selection.addRange(range);
			    document.execCommand("Copy");			    
			}
		}
	</script>
@stop