@extends('frontend.master')
@section('main')
	<div class="breadcrumbs">

		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.nap_tien') }}</h1>

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
						<article class="art-accounts art-bark">
							<div class="accounts-content">
								<form class="recharge-form" id="recharge-form" action="{{route('home.post-nap-tien')}}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="form-content">
										<div class="form-group">
											<label>{{ trans('message.nguoi_gui') }}</label>
											<input type="text" name="sender" class="form-control">
											<span class="error-message error_sender"></span>
										</div>
										<div class="form-group">
											<label>{{ trans('message.ngan_hang') }}</label>
											<select class="form-control" name="bankname">
												<option value="">{{ trans('message.chon_ngan_hang') }}</option>
												<option value="1">Ngân hàng 1</option>
												<option value="2">Ngân hàng 2</option>
												<option value="3">Ngân hàng 3</option>
											</select>
											<span class="error-message error_bankname"></span>
										</div>
										<div class="form-group">
											<label>{{ trans('message.so_tien') }}</label>
											<input type="text" name="amount_money" class="form-control">
											<span class="error-message error_amount_money"></span>
										</div>
										<div class="form-group">
											<label>{{ trans('message.nguoi_nhan') }}</label>
											<select class="form-control" name="receiver">
												<option value="">{{ trans('message.chon_nguoi_nhan') }}</option>
												<option value="1">Số tài khoản - Ngân hàng 1</option>
												<option value="2">Số tài khoản - Ngân hàng 2</option>
												<option value="3">Số tài khoản - Ngân hàng 3</option>
											</select>
										<span class="error-message error_receiver"></span>
										</div>
										<div class="form-group">
											<div class="recharge-bill">
												<label>{{ trans('message.anh_bil_chuyen_tien') }}:</label>
												<div class="image">
													<img style="max-width: 250px" src="{{url('/')}}/public/images/img-bill.png" alt="Bill" class="preview-img">
													</br><span class="error-message error_filename"></span>
													<input type="file" name="filename" id="filename" class="upimage">
												</div>
											</div>												
										</div>
										<div class="form-group">
											<label>{{ trans('message.ma_giao_dich') }}</label>
											<input type="text" name="trading_code" class="form-control">
											<span class="error-message error_trading_code"></span>
										</div>
										<div class="form-group">
											<label>{{ trans('message.ghi_chu') }}</label>
											<textarea type="text" name="note" class="form-control"></textarea>
										</div>
										<div class="form-group">
											<div class="button">
												<button class="btn btn-nap-tien">{{ trans('message.thuc_hien') }}</button>
											</div>												
										</div>
									</div>
								</form>
							</div>
						</article>
					</div>
				</div>
			</div>				

		</div>

	</main> <!--main-->
@stop