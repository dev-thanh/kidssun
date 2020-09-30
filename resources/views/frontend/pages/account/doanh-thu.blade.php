<?php 
	$status = request()->status ? request()->status : '';
	$start_date = request()->start_date ? request()->start_date : '';
	$end_date = request()->end_date ? request()->end_date : '';
?>
@extends('frontend.master')
@section('main')
	<style type="text/css" media="screen">
		#table1_paginate{
			float: right;
			margin-left: -30px
		}
		table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting:after {
		    content: "";
		}
		#table1_paginate .pagination a{
			border-radius: unset
		}
		#table1_wrapper{
			display: unset
		}
	</style>
	<div class="breadcrumbs">

		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.lich_su_mua_hang') }}</h1>

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
										<div class="advanced-search-block advanced-search-block-2">
											<form class="advanced-search-form">
												<div class="form-content" style="align-items: flex-end">
													<div class="form-group">
														<!-- <label class="input-group-addon" for="startDate">
							                                Từ ngày
							                            </label> -->
														<input type="text" name="start_date" value="{{@$start_date}}" class="form-control search-start" readonly id="startDate" placeholder="{{ trans('message.tu_ngay') }}">
													</div>
													<div class="form-group">
														<!-- <label class="input-group-addon" for="startDate">
							                                Đến ngày
							                            </label> -->
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
										<table id="table1" border="1" class="products-table">
											<thead>
												<tr>
													<th>STT</th>
						                            <th>{{ trans('message.hoa_hong_tu') }}</th>
						                            <th>{{ trans('message.ma_don_hang') }}</th>
						                            <th>{{ trans('message.so_tien') }}</th>
						                            <th>{{ trans('message.ngay_nhan') }}</th>
						                            <th>Note</th>
												</tr>
											</thead>
											<tbody>
												<?php $tong=0; ?>
												@foreach($data as $k => $item)
												<tr>
													<td>{{ $loop->index +1 }}</td>
						                            <td>@if(app()->getLocale() == 'vi')
						                                {{ $item->name_capduoi !='' ? $item->name_capduoi : 'Đơn hàng' }}
						                                @else
						                                {{ $item->name_capduoi !='' ? $item->name_capduoi : trans('message.don_hang') }}
						                                @endif
						                            </td>
						                            <td>{{ $item->mavd }}</td>
						                            <td>{{number_format($item->money, 0, '.', '.')}} đ</td>
						                            <td>{{format_datetime($item->ngay_nhan,'d-m-Y')}}</td>
						                            <td>{{ app()->getLocale() == 'vi' ? $item->name_status : $item->name_status_en }}</td>
												</tr>
												<?php $tong+= $item->money; ?>
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
		$(document).ready(function() {
            $('#table1').DataTable( {      
                 "searching": false,
                 "paging": true, 
                 "info": false,         
                 "lengthChange":false ,
                 language: {
			        paginate: {
			            previous: '‹',
			            next:     '›'
			        },
			        aria: {
			            paginate: {
			                previous: 'Previous',
			                next:     'Next'
			            }
			        }
			    }
            } );
        });
	</script>
@stop