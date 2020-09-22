<?php 
	$mentor = request()->mentor ? request()->mentor : '';
	$status = request()->status ? request()->status : '';
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

							<h1 class="title">{{ trans('message.dai_ly_cap_duoi') }}</h1>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>



	<main class="main-site products-site">

		<div class="main-container">

			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
						@include('frontend.pages.product.side-nav-left')
					</div>

					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
						<article class="art-products">
							<div class="products-box">
								<div class="products-content">
									<div class="content-header">
										<div class="advanced-search-block">
											<form class="advanced-search-form">
												<div class="form-content">
													<div class="form-group">
														<select class="form-control" name="mentor">
															<option value="">{{ trans('message.theo_dai_ly') }}</option>
															@foreach($thanhvien as $item)
															<option @if($mentor == $item->id) selected @endif value="{{$item->id}}">{{$item->full_name}}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group">
														<select class="form-control" name="status">
															<option value="">{{ trans('message.trang_thai') }}</option>
															@foreach($all_status as $item)
															<option value="{{$item->id}}" @if($status == $item->id) selected @endif>{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group">
														<input type="text" name="start_date" value="{{@$start_date}}" class="form-control search-start" readonly id="startDate" placeholder="{{ trans('message.tu_ngay') }}">
													</div>
													<div class="form-group">
														<input type="text" name="end_date" value="{{@$end_date}}" class="form-control search-input" readonly id="endDate" placeholder="{{ trans('message.den_ngay') }}">
													</div>
													<div class="form-group">
														<button class="btn search-btn">
															<span>{{ trans('message.tim_kiem') }}</span>
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>

									<div class="table-content">
										<table border="1" class="products-table">
											<thead>
												<tr>
													<th>STT</th>
													<th>{{ trans('message.ma_don_hang') }}</th>
													<th>{{ trans('message.thanh_tien') }}</th>
													<th>{{ trans('message.thanh_vien') }}</th>
													<th>{{ trans('message.trang_thai') }}</th>
													<th>{{ trans('message.chi_tiet') }}</th>
												</tr>
											</thead>
											<tbody>
												<?php $tong=0; ?>
												@foreach($orders as $k => $item)
												<tr>
													<td>
														<span>{{$k+1}}</span>
													</td>
													<td>
														<a href="#" title="Mã đơn" class="code-orders">
															<span>{{$item->mavd}}</span>
														</a>
													</td>
													<td>
														<div class="product-prices">
															<span class="price">{!! number_format(@$item->tongtien, 0, '.', '.')!!} đ</span>
														</div>
													</td>
													<td>
														<a href="#" title="Mã thành viên" class="code-members">
															<span>{{$item->full_name}}</span>
														</a>
													</td>
													<td class="status">
														<span>{{ app()->getLocale() == 'vi' ? $item->name_status : $item->nameen_status }}</span>
													</td></span>
													</td>														
													<td>
														<a href="#" class="code-orders show-order-detal" data-id="{{$item->id}}">
															<i class="far fa-eye icon"></i>
														</a>
													</td>
												</tr>
												<?php $tong+= $item->tongtien; ?>
												@endforeach
											</tbody>
										</table>
									</div>

									<div class="table-footer">
										<div class="product-total">
											<label>{{ trans('message.tong') }}:</label>
											<span>{!! number_format($tong, 0, '.', '.')!!} đ</span>
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
	<div class="art-popups art-popups-code-orders">
		<div class="popups-box">
			<div class="popups-content">
				<div class="popup-content active">
				<div class="title-box title-popup">
					<h3 class="title"><span>{{ trans('message.don_hang') }}</span></h3>
				</div>
				<div class="popup-content">
					<div class="products-content">
						<div class="table-content order-detail-content center">
							
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
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
		    var sd = @if($start_date !='') '{{$start_date}}' @else new Date() @endif;
		    var ed = new Date();
		  
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