<?php 
	$search = request()->search ? request()->search : '';
	$start_date = request()->start_date ? request()->start_date : '';
	$end_date = request()->end_date ? request()->end_date : '';
?>
@extends('frontend.master')
@section('main')
	<div class="breadcrumbs">

		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.lich_su_nap_tien') }}</h1>

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
								<div class="content" style="display: block;">
									<div class="advanced-search-block">
										<form class="advanced-search-form advanced-search-form-2">
											<div class="form-content">
												<div class="form-group">
													<input type="text" name="search" value="{{@$search}}" class="form-control" placeholder="{{ trans('message.ma_giao_dich') }}">
												</div>
												<div class="form-group">
													<input type="text" name="start_date" value="{{@$start_date}}" class="form-control search-start" readonly id="startDate" placeholder="{{ trans('message.tu_ngay') }}">
												</div>
												<div class="form-group">
													<input type="text" name="end_date" value="{{@$end_date}}" class="form-control search-input" readonly id="endDate" placeholder="{{ trans('message.den_ngay') }}">
												</div>

												<div class="form-group">
													<button class="btn">
														<span>{{ trans('message.tim_kiem') }}</span>
													</button>
												</div>
											</div>
										</form>
									</div>

									<div class="single-menus">
										<div class="table-content">
											<table>
											  <tr class="title-table">
											    <th class="center">{{ trans('message.thoi_gian') }}</th>
											    <th class="center">{{ trans('message.loai_giao_dich') }}</th>
											    <th class="center">{{ trans('message.ma_giao_dich') }}</th>
											    <th class="center">{{ trans('message.gia_tri_giao_dich') }}</th>
											    <th class="center">{{ trans('message.trang_thai') }}</th>
											  </tr>
											  	@if(!empty(@$recharge))
													@foreach(@$recharge as $item)
												  	<tr class="content-table">
													    <td class="center">Ngày {{format_datetime($item->created_at,'d-m-y')}}</td>
													    <td class="center">{{ trans('message.nap_tien') }}</td>
													    <td class="center">{{@$item->trading_code}}</td>
													    <td class="center">{!! number_format(@$item->amount_money, 0, '.', '.')!!} đ</td>
													    <td class="center">{{ app()->getLocale() == 'vi' ? $item->name_status : $item->nameen_status }}</td>
												  	</tr>
												  	@endforeach
											  	@endif
											  <!-- <tr class="content-table">
											    <td class="">Ngày 25 - 30/09/2020</td>
											    <td class="">Nạp tiền</td>
											    <td class="">#GD12345678900001</td>
											    <td class="center">10.000.000đ</td>
											    <td class="">Chờ xác nhận</td>
											  </tr> -->
											</table>
										</div>
										<div class="export-excel">
											<a href="{{route('home.export-giaodich',['search'=>$search,'start_date'=>$start_date,'end_date'=>$end_date])}}" download>
												<i class="fal fa-file-excel icon icon-excel"></i>
												<span>{{ trans('message.xuat_exel') }}</span>
											</a>
											<!-- <a href="rut-tien.html" class="btn withdrawal-btn">
												<span>Rút tiền</span>
											</a> -->
										</div>
									</div>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>				

		</div>

	</main> <!--main-->
	<script type="text/javascript">
		var bindDateRangeValidation = function (f, s, e) {
		    if(!(f instanceof jQuery)){
					console.log("Not passing a jQuery object");
		    }
		  
		    var jqForm = f,
		        startDateId = s,
		        endDateId = e;
		  
		    var checkDateRange = function (startDate, endDate) {
		        var isValid = (startDate != "" && endDate != "") ? startDate <= endDate : true;
		        return isValid;
		    }

		    var bindValidator = function () {
		        var bstpValidate = jqForm.data('bootstrapValidator');
		        var validateFields = {
		            startDate: {
		                validators: {
		                    notEmpty: { message: 'This field is required.' },
		                    callback: {
		                        message: 'Start Date must less than or equal to End Date.',
		                        callback: function (startDate, validator, $field) {
		                            return checkDateRange(startDate, $('#' + endDateId).val())
		                        }
		                    }
		                }
		            },
		            endDate: {
		                validators: {
		                    notEmpty: { message: 'This field is required.' },
		                    callback: {
		                        message: 'End Date must greater than or equal to Start Date.',
		                        callback: function (endDate, validator, $field) {
		                            return checkDateRange($('#' + startDateId).val(), endDate);
		                        }
		                    }
		                }
		            },
		          	customize: {
		                validators: {
		                    customize: { message: 'customize.' }
		                }
		            }
		        }
		        if (!bstpValidate) {
		            jqForm.bootstrapValidator({
		                excluded: [':disabled'], 
		            })
		        }
		      
		        jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
		        jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);
		      
		    };

		    var hookValidatorEvt = function () {
		        var dateBlur = function (e, bundleDateId, action) {
		            jqForm.bootstrapValidator('revalidateField', e.target.id);
		        }

		        $('#' + startDateId).on("dp.change dp.update blur", function (e) {
		            $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
		            dateBlur(e, endDateId);
		        });

		        $('#' + endDateId).on("dp.change dp.update blur", function (e) {
		            $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
		            dateBlur(e, startDateId);
		        });
		    }

		    bindValidator();
		    hookValidatorEvt();
		};


		$(function () {
		    var sd = new Date(), ed = new Date();
		  
		    $('#startDate').datetimepicker({ 
		      pickTime: false, 
		      format: "DD-MM-YYYY", 
		      // defaultDate: @if(@$stdf) '{{@$stdf}}' @else sd @endif, 
		      maxDate: ed 
		    });
		  
		    $('#endDate').datetimepicker({ 
		      pickTime: false, 
		      format: "DD-MM-YYYY", 
		      // defaultDate: @if(@$endf) '{{@$endf}}' @else ed @endif,
		      minDate: sd 
		    });

		    //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
		    bindDateRangeValidation($("#form"), 'startDate', 'endDate');
		});
	</script>
@stop