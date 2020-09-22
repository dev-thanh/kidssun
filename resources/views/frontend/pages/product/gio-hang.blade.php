@extends('frontend.master')
@section('main')
<style type="text/css" media="screen">
	.disabled-click{
		pointer-events:none
	}
	input[type=number]::-webkit-outer-spin-button,
	input[type=number]::-webkit-inner-spin-button {
	    -webkit-appearance: none;
	    margin: 0;
	}

	input[type=number] {
	    -moz-appearance:textfield;
	}
</style>
	<div class="breadcrumbs">

		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">{{ trans('message.gio_hang') }}</h1>

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
									<div class="table-content">
										<table border="1" class="products-table">
											<thead>
												<tr>
													<th>{{ trans('message.san_pham') }}</th>
													<th>{{ trans('message.gia_ban') }}</th>
													<th>{{ trans('message.so_luong') }}</th>
													<th>{{ trans('message.thanh_tien') }}</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@if(Cart::count() != 0)
													@foreach (Cart::content() as $item)
													<tr>
														<td>
															<div class="product-box">
																<div class="product-image">
																	<a href="#">
																		<img src="{{url('/')}}/{{$item->options->image}}" style="max-width: 100px; max-height: 100px; width: 100%; height: 100%;">
																	</a>
																</div>
																<div class="product-content">
																	<h4 class="product-name">
																		<a href="#" class="product-link">{{ app()->getLocale() == 'vi' ? $item->name : $item->options->name_en }}</a>
																	</h4>
																</div>	
															</div>
														</td>
														<td>
															<div class="product-prices">
																<span class="price">{{number_format(@$item->price, 0, '.', '.')}}vnđ</span>
															</div>
														</td>
														<td>
															<input type="hidden" name="get_id_product" data-url="{{route('home.update-giohang')}}" value="{{$item->rowId}}">
															<div class="qty">
																<button class="btn icon-minus icon-minus-pre"><i class="far fa-minus icon"></i></button>
																<input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="product_qty" value="{{$item->qty}}">
																<button class="btn icon-minus icon-minus-next"><i class="far fa-plus icon"></i></button>
															</div>
														</td>
														<td>
															<div class="product-prices">
																<span class="price cartitem-price">{{number_format($item->price*$item->qty, 0, '.', '.')}}vnđ</span>
															</div>
														</td>
														<td>	
															<a href="{{route('home.remove-card')}}" class="delete delete-cart">
																<i class="far fa-trash-alt icon"></i>
																<span>{{ trans('message.xoa') }}</span>
															</a>
														</td>
													</tr>
													@endforeach
												@else
													<tr>
														<td colspan="5" rowspan="" headers="">{{ trans('message.khong_co_san_pham') }}</td>
													</tr>
												@endif
												
												
											</tbody>
										</table>
									</div>

									<div class="table-footer">
										<div class="button">
											<a href="{{route('home.destroy-card')}}" class="btn delete">{{ trans('message.huy_gio_hang') }}</a>
											<!-- <a href="#" class="btn">{{ trans('message.cap_nhap') }}</a> -->
											<a href="{{route('home.dat-hang')}}" onclick="return confirm('Bạn có chắc chắn đặt hàng không ?')" class="btn">{{ trans('message.thanh_toan') }}</a>
										</div>
										<div class="product-total">
											<label>{{ trans('message.tam_tinh') }}:</label>
											<span class="total-cart">{{number_format(Cart::total(), 0, '.', '.')}} vnđ</span>
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
@stop