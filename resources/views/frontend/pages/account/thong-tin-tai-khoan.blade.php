<?php $tab = request()->get('tab') ? request()->get('tab') : ''; ?>
@extends('frontend.master')
@section('main')
<style type="text/css" media="screen">
	.error-message{
		width: 100%;
	    text-align: center;
	    color: red;
	}
</style>
	<div class="breadcrumbs">
		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">


					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">Thông tin tài khoản</h1>

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
												<a href="#" class="information-title @if($tab =='tttk' || $tab =='') active @endif">Thông tin tài khoản</a>
											</li>
											<li>
												<a href="#" class="password-title">Mật khẩu</a>
											</li>
											<li>
												<a href="#" class="url-title">Url giới thiệu</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="accounts-content">
								<div class="information-box active">
									<form class="forms" method="POST" id="cap_nhap_thong_tin" action="{{route('home.cap-nhap-tai-khoan')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-content">
											<input type="hidden" name="member_id" value="{{$member->id}}">
											<div class="form-group">
												<label>Họ và tên</label>
												<input class="form-control" type="text" name="full_name" placeholder="" value="{!! old('full_name', @$member->full_name) !!}">
												
												<span class="error-message error_full_name"></span>
												
											</div>	
											<div class="form-group form-no-input">
												<label>Tên truy cập</label>
												<input class="form-control" value="{{$member->user_name}}" type="text" name="user_name" placeholder="">
												
											</div>	
											<div class="form-group">
												<label>Mail</label>
												<input class="form-control" value="{!! old('email', @$member->email) !!}" type="text" name="email" placeholder="">
												
												<span class="error-message error_email"></span>
												
											</div>	
											<div class="form-group">
												<label>Điện thoại</label>
												<input class="form-control" type="text" value="{!! old('phone', @$member->phone) !!}" name="phone" placeholder="">
												
												<span class="error-message error_phone"></span>
												
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
													<button class="btn btn-cap-nhap-thong-tin">Cập nhật</button>
												</div>
											</div>	
										</div>
									</form>
								</div>

								<div class="password-box">
									<form class="forms" action="{{route('home.cap-nhap-mat-khau')}}" id="thay_doi_mat_khau" method="POST">
										@csrf
										<div class="form-content">
											<div class="form-group">
												<label>Mật khẩu cũ</label>
												<input class="form-control" type="text" name="old_password" placeholder="">
												<span class="fr-error">Lỗi</span>
											</div>
											<div class="form-group">
												<label>Mật khẩu mới</label>
												<input class="form-control" type="text" name="new_password" placeholder="">
												<span class="fr-error">Lỗi</span>
											</div>
											<div class="form-group">
												<label>Nhập lại mật khẩu mới</label>
												<input class="form-control" type="text" name="renew_password" placeholder="">
												<span class="fr-error">Lỗi</span>
											</div>											

											<div class="form-group">
												<div class="button">				
													<button class="btn btn-thay-doi-mat-khau">Cập nhật</button>
												</div>
											</div>	
										</div>
									</form>
								</div>

								<div class="url-box">
									<ul>
										<li>
											<a href="{{route('home.index',['ma-gioi-thieu'=>$member->code])}}">{{route('home.index',['ma-gioi-thieu'=>$member->code])}}</a>
											<a href="#" class="btn">Copy</a>
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
		
		

	</script>
@stop