<table border="1" class="products-table">
	<thead>
		<tr>
			<th>STT</th>
			<th>{{ trans('message.ten_san_pham') }}</th>
			<th>{{ trans('message.don_gia') }}</th>
			<th>{{ trans('message.so_luong') }}</th>
			<th>{{ trans('message.thanh_tien') }}</th>
			<th>{{ trans('message.ngay_mua') }}</th>
			<!-- <th>Trạng thái</th> -->
		</tr>
	</thead>
	<tbody>
		@foreach($order_details as $k =>$item)
		<tr>
			<td>
				<span>{{$k+1}}</span>
			</td>
			<td>
				<a href="#" title="Sản phẩm" class="product-link">
					<span>{{ app()->getLocale() == 'vi' ? $item->product_name : $item->product_name_en }}</span>
				</a>
			</td>
			<td>
				<div class="product-prices">
					<span class="price">{!! number_format(@$item->price, 0, '.', '.')!!} đ</span>
				</div>
			</td>
			<td>
				<span>{{$item->qty}}</span>
			</td>
			<td>
				<div class="product-prices">
					<span class="price">{!! number_format(@$item->price_total, 0, '.', '.')!!} đ</span>
				</div>
			</td>
			<td>
				<span>{{format_datetime($item->created_at,'d-m-Y')}}</span>
			</td>
			<!-- <td class="status">
				<span>Chờ xác nhận</span>
			</td> -->
		</tr>
		@endforeach
	</tbody>
</table>