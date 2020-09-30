<aside class="art-sidebars">
	<div class="sidebars-box">
		<div class="title-box title-sidebars">
			<h3 class="title">{{ trans('message.doanh_thu') }}</h3>
		</div>
		<div class="sidebars-content">
			<ul>
				<li class="{{ Request::route()->getName() =='home.quan-ly-dai-ly' ? 'active' : null }}">
					<a href="{{route('home.quan-ly-dai-ly')}}" title="{{ trans('message.quan_ly_dai_ly') }}">{{ trans('message.quan_ly_dai_ly') }}</a>
				</li>
				
				<li class="{{ Request::route()->getName() =='home.lich-su-mua-hang-dlcd' ? 'active' : null }}">
					<a href="{{route('home.lich-su-mua-hang-dlcd')}}" title="{{ trans('message.lich_su_mua_hang_dai_ly') }}">{{ trans('message.lich_su_mua_hang_dai_ly') }}</a>
				</li>
				<li class="{{ Request::route()->getName() =='home.doanh-thu' ? 'active' : null }}">
					<a href="{{route('home.doanh-thu')}}" title="{{ trans('message.lich_su_mua_hang_dai_ly') }}">{{ trans('message.doanh_thu') }}</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="sidebars-box">
		<div class="title-box title-sidebars">
			<h3 class="title">{{ trans('message.san_pham') }}</h3>
		</div>
		<div class="sidebars-content">
			<ul>
				<li class="{{ Request::route()->getName() =='home.list-products' ? 'active' : null }}">
					<a href="{{route('home.list-products')}}" title="{{ trans('message.danh_sach_san_pham') }}">{{ trans('message.danh_sach_san_pham') }}</a>
				</li>
				<li class="{{ Request::route()->getName() =='home.gio-hang' ? 'active' : null }}">
					<a href="{{route('home.gio-hang')}}" title="{{ trans('message.gio_hang') }}">{{ trans('message.gio_hang') }} <span class="count-cart">( {{ Cart::count() }} )</span></a>
				</li>
			</ul>
		</div>
	</div>

	<div class="sidebars-box">
		<div class="title-box title-sidebars">
			<h3 class="title">{{ trans('message.tai_khoan') }}</h3>
		</div>
		<div class="sidebars-content">
			<ul>
				<li class="{{ Request::route()->getName() =='home.thong-tin-tai-khoan' ? 'active' : null }}">
					<a href="{{route('home.thong-tin-tai-khoan')}}" title="{{ trans('message.thong_tin_tai_khoan') }}">{{ trans('message.thong_tin_tai_khoan') }}</a>
				</li>
				<li class="{{ Request::route()->getName() =='home.lich-su-mua-hang' ? 'active' : null }}">
					<a href="{{route('home.lich-su-mua-hang')}}" title="{{ trans('message.lich_su_mua_hang') }}">{{ trans('message.lich_su_mua_hang') }}</a>
				</li>
				<li class="{{ Request::route()->getName() =='home.tai-khoan-ngan-hang' ? 'active' : null }}">
					<a href="{{route('home.tai-khoan-ngan-hang')}}" title="{{ trans('message.tai_khoan_ngan_hang') }}">{{ trans('message.tai_khoan_ngan_hang') }}</a>
				</li>
				<li class="{{ Request::route()->getName() =='home.nap-tien' ? 'active' : null }}">
					<a href="{{route('home.nap-tien')}}" title="{{ trans('message.nap_tien') }}">{{ trans('message.nap_tien') }}</a>
				</li>
				<li class="{{ Request::route()->getName() =='home.lich-su-giao-dich' ? 'active' : null }}">
					<a href="{{route('home.lich-su-giao-dich')}}" title="{{ trans('message.lich_su_nap_tien') }}">{{ trans('message.lich_su_nap_tien') }}</a>
				</li>
			</ul>
		</div>
	</div>
</aside>