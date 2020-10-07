<?php
    $month = request()->month && request()->month !='' ? request()->month : now()->month;
    $year = request()->year && request()->year !='' ? request()->year : now()->year;
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
		.advanced-search-form select{
			font-size: 16px;
    		padding: 2px;
		}
		.advanced-search-form label{
			color: #000
		}
	</style>
	<div class="breadcrumbs">

		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.tinh_luong') }}</h1>

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
												
												<div style="font-size: 18px;display: inline-flex;">
							                      <label style="margin-right: 10px">Năm:
							                        <select id="yearSelector" class="get-year">
							                       		@for($i=2019;$i<=now()->year;$i++)
							                          		<option value="{{$i}}" @if($year == $i) selected="selected" @endif>{{$i}}</option>
							                          	@endfor
							                        </select>
							                      </label>
							                      <label>Tháng:
							                        <select id="monthSelector">
							                            @for($i=01;$i<13;$i++)
							                            @if($i < 10)
							                            <option value="0{{$i}}" @if($month==$i) selected @endif>{{$i}}</option>
							                            @else
							                            <option value="{{$i}}" @if($month==$i) selected @endif>{{$i}}</option>
							                            @endif
							                          @endfor
							                        </select>
							                      </label>
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
												@if(count($data)==0)
													<tr>
														@if(app()->getLocale() == 'vi')
														<td colspan="6" rowspan="" headers="">Không tìm thấy dữ liệu nào</td>
														@else
														<td colspan="6" rowspan="" headers="">No data found</td>
														@endif
													</tr>
												@endif
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
											<span>{!! number_format($tong+@$luong->bu_tru, 0, '.', '.')!!} đ</span>
										</div>
									</div>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>				

		</div>
		<input type="hidden" name="" id="url_chitiet_luong" value="{{route('home.doanh-thu')}}">
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
        $('select').change(function () {
            var url = $('#url_chitiet_luong').val();
            var month = $('#monthSelector').val();
            var year = $('.get-year').val();
            // var month = $('.get-month').val();
            window.location.href = url+'?year='+year+'&month='+month;
        });
    </script>
@stop