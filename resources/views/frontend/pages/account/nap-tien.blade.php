@extends('frontend.master')
@section('main')
	<style type="text/css" media="screen">
		.nhap-so-tien{
			position: relative;
		}
		.money-vnd{
			position: absolute;
			top: 0;
			height: 100%;
			right: 0;
			background: #eee;
			border:1px solid #ccc
		}
		.money-vnd div{
			padding: 6px 10px;
		}
	</style>
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
											<select class="form-control" id="ngan-hang-gui" name="bankname">
												<option value="">{{ trans('message.chon_ngan_hang') }}</option>
												<option value="Ngân hàng An Bình(ABBANK)">Ngân hàng An Bình(ABBANK)</option>

												<option value="Ngân hàng Á Châu(ACB)">Ngân hàng Á Châu(ACB)</option>

												<option value="Ngân hàng NN&PT Nông thôn Việt Nam(Agribank)">Ngân hàng NN&PT Nông thôn Việt Nam(Agribank)</option>

												<option value="Ngân hàng ANZ Việt Nam(ANZVL)">Ngân hàng ANZ Việt Nam(ANZVL)</option>

												<option value="Ngân hàng Bắc Á(Bac A Bank)">Ngân hàng Bắc Á(Bac A Bank)</option>

												<option value="Ngân hàng Bảo Việt(BAOVIET Bank)">Ngân hàng Bảo Việt(BAOVIET Bank)</option>

												<option value="Ngân hàng Đầu tư và Phát triển Việt Nam(BIDV)">Ngân hàng Đầu tư và Phát triển Việt Nam(BIDV)</option>

												<option value="Ngân hàng Xây dựng(CB)">Ngân hàng Xây dựng(CB)</option>

												<option value="Ngân hàng CIMB Việt Nam(CIMB)">Ngân hàng CIMB Việt Nam(CIMB)</option>

												<option value="Ngân hàng Hợp tác xã Việt Nam(Co-opBank)">Ngân hàng Hợp tác xã Việt Nam(Co-opBank)</option>

												<option value="Ngân hàng Đông Á(DongA Bank)">Ngân hàng Đông Á(DongA Bank)</option>
												<option value="Ngân hàng Xuất Nhập Khẩu(Eximbank)">Ngân hàng Xuất Nhập Khẩu(Eximbank)</option>

												<option value="Ngân hàng Dầu khí toàn cầu(GPBank)">Ngân hàng Dầu khí toàn cầu(GPBank)</option>

												<option value="Ngân hàng Phát triển TPHồ Chí Minh(HDBank)">Ngân hàng Phát triển TPHồ Chí Minh(HDBank)</option>
												<option value="Ngân hàng Hong Leong Việt Nam(HLBVN)">Ngân hàng Hong Leong Việt Nam(HLBVN)</option>

												<option value="Ngân hàng HSBC Việt Nam(HSBC)">Ngân hàng HSBC Việt Nam(HSBC)</option>

												<option value="Ngân hàng Indovina(IVB)">Ngân hàng Indovina(IVB)</option>

												<option value="Ngân hàng Kiên Long(Kienlongbank)">Ngân hàng Kiên Long(Kienlongbank)</option>
												<option value="Ngân hàng Bưu điện Liên Việt(LienVietPostBank)">Ngân hàng Bưu điện Liên Việt(LienVietPostBank)</option>
												<option value="Ngân hàng Quân Đội(MB)">Ngân hàng Quân Đội(MB)</option>

												<option value="Ngân hàng Hàng Hải(MSB)">Ngân hàng Hàng Hải(MSB)</option>

												<option value="Ngân hàng Nam Á(Nam A Bank)">Ngân hàng Nam Á(Nam A Bank)</option>
												<option value="Ngân hàng Quốc dân(NCB)">Ngân hàng Quốc dân(NCB)</option>

												<option value="Ngân hàng Phương Đông(OCB)">Ngân hàng Phương Đông(OCB)</option>
												<option value="Ngân hàng Đại Dương(OceanBank)">Ngân hàng Đại Dương(OceanBank)</option>
												<option value="Ngân hàng Public Bank Việt Nam(PBVN)">Ngân hàng Public Bank Việt Nam(PBVN)</option>
												<option value="Ngân hàng Xăng dầu Petrolimex(PG Bank)">Ngân hàng Xăng dầu Petrolimex(PG Bank)</option>
												<option value="Ngân hàng Đại Chúng Việt Nam(PVcomBank)">Ngân hàng Đại Chúng Việt Nam(PVcomBank)</option>
												<option value="Ngân hàng Sài Gòn Thương Tín(Sacombank)">Ngân hàng Sài Gòn Thương Tín(Sacombank)</option>
												<option value="Ngân hàng Sài Gòn Công Thương(SAIGONBANK)">Ngân hàng Sài Gòn Công Thương(SAIGONBANK)</option>
												<option value="Ngân hàng Sài Gòn(SCB)">Ngân hàng Sài Gòn(SCB)</option>
												<option value="Ngân hàng Standard Chartered Việt Nam(SCBVL)">Ngân hàng Standard Chartered Việt Nam(SCBVL)</option>
												<option value="Ngân hàng Đông Nam Á(SeABank)">Ngân hàng Đông Nam Á(SeABank)</option>
												<option value="Ngân hàng Sài Gòn – Hà Nội(SHB)">Ngân hàng Sài Gòn – Hà Nội(SHB)</option>
												<option value="Ngân hàng Shinhan Việt Nam(SHBVN)">Ngân hàng Shinhan Việt Nam(SHBVN)</option>
												<option value="Ngân hàng Kỹ Thương(Techcombank)">Ngân hàng Kỹ Thương(Techcombank)</option>
												<option value="Ngân hàng Tiên Phong(TPBank)">Ngân hàng Tiên Phong(TPBank)</option>
												<option value="Ngân hàng UOB Việt Nam(UOB)">Ngân hàng UOB Việt Nam(UOB)</option>
												<option value="Ngân hàng Chính sách xã hội Việt Nam(VBSP)">Ngân hàng Chính sách xã hội Việt Nam(VBSP)</option>
												<option value="Ngân hàng Phát triển Việt Nam(VDB)">Ngân hàng Phát triển Việt Nam(VDB)</option>
												<option value="Ngân hàng Quốc Tế(VIB)">Ngân hàng Quốc Tế(VIB)</option>
												<option value="Ngân hàng Bản Việt(Viet Capital Bank)">Ngân hàng Bản Việt(Viet Capital Bank)</option>
												<option value="Ngân hàng Việt Á(VietABank)">Ngân hàng Việt Á(VietABank)</option>
												<option value="Ngân hàng Việt Nam Thương Tín(Vietbank)">Ngân hàng Việt Nam Thương Tín(Vietbank)</option>
												<option value="Ngân hàng Ngoại Thương Việt Nam(Vietcombank)">Ngân hàng Ngoại Thương Việt Nam(Vietcombank)</option>
												<option value="Ngân hàng Công thương Việt Nam(VietinBank)">Ngân hàng Công thương Việt Nam(VietinBank)</option>
												<option value="Ngân hàng Việt Nam Thịnh Vượng(VPBank)">Ngân hàng Việt Nam Thịnh Vượng(VPBank)</option>
												<option value="Ngân hàng Việt – Nga(VRB)">Ngân hàng Việt – Nga(VRB)</option>
												<option value="Ngân hàng Woori Việt Nam(Woori)">Ngân hàng Woori Việt Nam(Woori)</option>
											</select>
											<span class="error-message error_bankname"></span>
										</div>
										<div class="form-group">
											<label>{{ trans('message.so_tien') }}</label>
											<!-- <input type="text" name="amount_money" class="form-control"> -->
											<div class="nhap-so-tien">
												<input type="text" class="form-control" id="amount_money" value="">
												<div class="money-vnd input-group-addon" for="endDate">
							                        <div >VNĐ</div>
							                    </div>
												<input type="hidden" name="amount_money">
											</div>
											<span class="error-message error_amount_money"></span>
										</div>
										<div class="form-group">
											<label>{{ trans('message.nguoi_nhan') }}</label>
											<select class="form-control" name="receiver">
												<option value="">{{ trans('message.chon_nguoi_nhan') }}</option>
												@foreach(@$banks as $item)

												<option value="{{$item->number}} - {{$item->name_account}} - {{$item->name_bank}}">{{$item->number}} - {{$item->name_account}} - {{$item->name_bank}}</option>

												@endforeach
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
	<script type="text/javascript">
		$('input#amount_money').keyup(function(event) {
		    if($(this).val() != ''){
		        $('.amount_money_error').html('');
		    }
		    if(event.which >= 37 && event.which <= 40) return;
		    $(this).val(function(index, value) {
		        return value
		        .replace(/\D/g, "")
		        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		        ;
		    });
		    var number = $(this).val().replace(/,/g, '');
		    $('input[name="amount_money"]').val(number);
		});
	</script>
	<script type="text/javascript">
		$(function () {
		  $("#ngan-hang-gui").select2();
		});
	</script>
@stop