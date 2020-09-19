<?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
@extends('frontend.master')
@section('main')
	<div class="breadcrumbs">

		<div class="breadcrumbs-content">

			<div class="container">

				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="title-box breadcrumbs-title title-left">

							<h1 class="title">Sản phẩm</h1>

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
									<div class="content">
										@foreach($data as $item)
										<div class="item">
											<div class="product-box">
												<div class="product-image">
													<a href="#">
														<img src="{{url('/')}}/{{$item->image}}" style="max-width: 500px; max-height: 500px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="product-content">
													<h4 class="product-name">
														<a href="#" class="product-link">{{ app()->getLocale() == 'vi' ? @$item->name : @$item->name_en }}</a>
													</h4>
													<div class="product-prices">
														<span class="price">{{number_format(@$item->price, 0, '.', '.')}}đ</span>
													</div>
													<div class="product-button">
														<a href="{{route('home.get-add-cart',['id'=>@$item->id])}}" title="Mua hàng" class="btn">
															<span>Mua hàng</span>
														</a>
													</div>
												</div>
											</div>
										</div>
										@endforeach
										<!-- <div class="item">
											<div class="product-box">
												<div class="product-image">
													<a href="#">
														<img src="assets/images/pr-01.jpg" style="max-width: 500px; max-height: 500px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="product-content">
													<h4 class="product-name">
														<a href="#" class="product-link">Tên sản phẩm</a>
													</h4>
													<div class="product-prices">
														<span class="price">200.000đ</span>
													</div>
													<div class="product-button">
														<a href="#" title="Mua hàng" class="btn">
															<span>Mua hàng</span>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="product-box">
												<div class="product-image">
													<a href="#">
														<img src="assets/images/pr-01.jpg" style="max-width: 500px; max-height: 500px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="product-content">
													<h4 class="product-name">
														<a href="#" class="product-link">Tên sản phẩm</a>
													</h4>
													<div class="product-prices">
														<span class="price">200.000đ</span>
													</div>
													<div class="product-button">
														<a href="#" title="Mua hàng" class="btn">
															<span>Mua hàng</span>
														</a>
													</div>
												</div>
											</div>
										</div>											
										<div class="item">
											<div class="product-box">
												<div class="product-image">
													<a href="#">
														<img src="assets/images/pr-01.jpg" style="max-width: 500px; max-height: 500px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="product-content">
													<h4 class="product-name">
														<a href="#" class="product-link">Tên sản phẩm</a>
													</h4>
													<div class="product-prices">
														<span class="price">200.000đ</span>
													</div>
													<div class="product-button">
														<a href="#" title="Mua hàng" class="btn">
															<span>Mua hàng</span>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="product-box">
												<div class="product-image">
													<a href="#">
														<img src="assets/images/pr-01.jpg" style="max-width: 500px; max-height: 500px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="product-content">
													<h4 class="product-name">
														<a href="#" class="product-link">Tên sản phẩm</a>
													</h4>
													<div class="product-prices">
														<span class="price">200.000đ</span>
													</div>
													<div class="product-button">
														<a href="#" title="Mua hàng" class="btn">
															<span>Mua hàng</span>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="product-box">
												<div class="product-image">
													<a href="#">
														<img src="assets/images/pr-01.jpg" style="max-width: 500px; max-height: 500px; width: 100%; height: 100%;">
													</a>
												</div>
												<div class="product-content">
													<h4 class="product-name">
														<a href="#" class="product-link">Tên sản phẩm</a>
													</h4>
													<div class="product-prices">
														<span class="price">200.000đ</span>
													</div>
													<div class="product-button">
														<a href="#" title="Mua hàng" class="btn">
															<span>Mua hàng</span>
														</a>
													</div>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</article>

						<article class="art-pagination">
							<div class="pagination-box">
								<div class="pagination">
									<ul>
										<li class="pagi-prev">
											<a href="{{route('home.list-products')}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif">
												<i class="fal fa-angle-double-left icon icon-prev" aria-hidden="true"></i>
												Prev
											</a>
										</li>
										@for($i = 0; $i < $data->lastpage(); $i++)
										<li class="" data-page="{{$i+1}}">
											<a href="{{route('home.list-products')}}?page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif">
												<span>{{$i+1}}</span>
											</a>
										</li>
										@endfor
										<li class="pagi-next">
											<a href="{{route('home.list-products')}}?page={{$curent_page+1}}" @if($curent_page==$data->lastpage()) onclick="return false;" @endif>
												Next
												<i class="fal fa-angle-double-right icon icon-next" aria-hidden="true"></i>
											</a>
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
	<script>
        jQuery(document).ready(function($) {
            $('[data-page="{{$curent_page}}"]').addClass('active');
        });
    </script>
@stop