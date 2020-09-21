<aside class="art-sidebars">
	<div class="sidebars-box">
		<div class="title-box title-sidebars">
			<h3 class="title">Doanh thu</h3>
		</div>
		<div class="sidebars-content">
			<ul>
				<li>
					<a href="quan-ly-dai-ly.html" title="Quản lý đại lý">Quản lý đại lý</a>
				</li>
				<li>
					<a href="lich-su-mua-hang.html" title="Lịch sử mua hàng">Lịch sử mua hàng của tôi</a>
				</li>
				<li>
					<a href="lich-su-mua-hang-dlbl.html" title="Lịch sử mua hàng">Lịch sử mua hàng của đại lý</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="sidebars-box">
		<div class="title-box title-sidebars">
			<h3 class="title">Sản phẩm</h3>
		</div>
		<div class="sidebars-content">
			<ul>
				<li>
					<a href="{{route('home.list-products')}}" title="Danh sách sản phẩm">Danh sách sản phẩm</a>
				</li>
				<li>
					<a href="{{route('home.gio-hang')}}" title="Giỏ hàng">Giỏ hàng <span class="count-cart">( {{ Cart::count() }} )</span></a>
				</li>
			</ul>
		</div>
	</div>

	<div class="sidebars-box">
		<div class="title-box title-sidebars">
			<h3 class="title">Tài khoản</h3>
		</div>
		<div class="sidebars-content">
			<ul>
				<li>
					<a href="{{route('home.thong-tin-tai-khoan')}}" title="Thông tin tài khoản">Thông tin tài khoản</a>
				</li>
				<li>
					<a href="tai-khoan-ngan-hang.html" title="Tài khoản ngân hàng">Tài khoản ngân hàng</a>
				</li>
				<li>
					<a href="nap-tien.html" title="Nạp tiền">Nạp tiền</a>
				</li>
				<li>
					<a href="lich-su-nap-tien.html" title="Lịch sử nạp tiền">Lịch sử nạp tiền</a>
				</li>
			</ul>
		</div>
	</div>
</aside>