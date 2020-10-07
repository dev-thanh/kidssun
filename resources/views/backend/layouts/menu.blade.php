<li class="header">TRANG QUẢN TRỊ</li>

<li class="{{ Request::segment(2) == 'home' ? 'active' : null  }}">
    <a href="{{ route('backend.home') }}">
        <i class="fa fa-home"></i> <span>Trang chủ</span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'users' ? 'active' : null  }}">
    <a href="{{ route('users.index') }}">
        <i class="fa fa-user"></i> <span>Tài khoản</span>
    </a>
</li>

<li class="treeview {{ Request::segment(2) === 'category' || Request::segment(2) === 'products' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Sản phẩm</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::segment(2) === 'products' ? 'active' : null }}">
            <a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i> Danh sách sản phẩm</a>
        </li>
        <li class="{{ Request::segment(2) === 'category' ? 'active' : null }}">
            <a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a>
        </li>
    </ul>
</li>

<li class="treeview {{ Request::route()->getName() == 'member.index' || Request::route()->getName() == 'recharge.index' ? 'active'  : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Đại lý</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::route()->getName() == 'member.index' ? 'active' : null }}">
            <a href="{{ route('member.index') }}"><i class="fa fa-circle-o"></i> Danh sách đại lý</a>
        </li>
        <li class="{{ Request::route()->getName() == 'recharge.index' ? 'active' : null }}">
            <a href="{{ route('recharge.index') }}"><i class="fa fa-circle-o"></i> Danh sách chuyển tiền</a>
        </li>
    </ul>
</li>

<li class="treeview {{ Request::route()->getName() == 'orders.index' || Request::route()->getName() == 'orders.doanh-thu' || Request::route()->getName() == 'orders.bang-luong' || Request::route()->getName() == 'orders.chi-tiet-luong' || Request::route()->getName() == 'orders.chi-tiet-luong' ? 'active'  : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Quản lý doanh thu</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::route()->getName() == 'orders.index' ? 'active' : null }}">
            <a href="{{ route('orders.index') }}"><i class="fa fa-circle-o"></i> Đơn hàng</a>
        </li>
        <li class="{{  Request::route()->getName() == 'orders.doanh-thu' ? 'active' : null }}">
            <a href="{{ route('orders.doanh-thu') }}"><i class="fa fa-circle-o"></i> Lịch sử nhận hoa hồng</a>
        </li>
        <li class="{{ Request::route()->getName() == 'orders.bang-luong' || Request::route()->getName() == 'orders.chi-tiet-luong' ? 'active' : null }}">
            <a href="{{ route('orders.bang-luong') }}"><i class="fa fa-circle-o"></i> Bảng lương</a>
        </li>
        
    </ul>
</li>

<li class="treeview {{ Request::segment(2) === 'picture' || Request::segment(2) === 'video' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Hình ảnh video</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::segment(2) === 'picture' ? 'active' : null }}">
            <a href="{{ route('picture.index') }}"><i class="fa fa-circle-o"></i> Danh sách hình ảnh</a>
        </li>
        <li class="{{ Request::segment(2) === 'video' ? 'active' : null }}">
            <a href="{{ route('video.index') }}"><i class="fa fa-circle-o"></i> Danh sách video</a>
        </li>
    </ul>
</li>

<li class="{{ Request::segment(2) == 'recruitment' ? 'active' : null  }}">
    <a href="{{ route('recruitment.index') }}">
        <i class="fa fa-tags" aria-hidden="true"></i> <span>Tuyển dụng</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'apply-job' ? 'active' : null  }}">
    <a href="{{ route('get.list.job') }}">
        <i class="fa fa-tags" aria-hidden="true"></i> <span>Danh sách đơn ứng tuyển</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'posts' ? 'active' : null  }}">
    <a href="{{ route('posts.index', ['type'=> 'blog']) }}">
        <i class="fa fa-tags" aria-hidden="true"></i> <span>Bài viết</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'pages' ? 'active' : null  }}">
    <a href="{{ route('pages.list') }}">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Cài đặt trang</span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'contact' ? 'active' : null  }}">
    <?php $number = \App\Models\Contact::where('status', 0)->count() ?>
    <a href="{{ route('get.list.contact') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Liên hệ ({{ $number }})
        </span>
    </a>
</li>
<li class="treeview {{ Request::segment(2) === 'config' || Request::segment(2) === 'banks' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Config</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::segment(2) === 'banks' ? 'active' : null }}">
            <a href="{{ route('banks.index') }}"><i class="fa fa-circle-o"></i> Tài khoản ngân hàng</a>
        </li>
        <li class="{{ Request::route()->getName() == 'config.index' || Request::route()->getName() == 'config.create' ? 'active' : null }}">
            <a href="{{ route('config.index') }}"><i class="fa fa-circle-o"></i> Cấp bậc đại lý</a>
        </li>
        <li class="{{ Request::route()->getName() == 'config.quyenloi' || Request::route()->getName() == 'config.update' ? 'active' : null }}">
            <a href="{{ route('config.quyenloi') }}"><i class="fa fa-circle-o"></i> Quyền lợi đại lý</a>
        </li>
    </ul>
</li>

<li class="header">Cấu hình hệ thống</li>
<li class="treeview {{ Request::segment(2) === 'options' || Request::segment(2) === 'images' || Request::segment(2) === 'menu' || Request::segment(2) === 'banks' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Cấu hình</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

         <li class="{{ Request::segment(3) === 'general' ? 'active' : null }}">
            <a href="{{ route('backend.options.general') }}"><i class="fa fa-circle-o"></i> Cấu hình chung</a>
        </li>
        <li class="{{ request()->get('type') == 'slider' ? 'active' : null }}">
            <a href="{{ route('image.index', ['type'=> 'slider']) }}"><i class="fa fa-circle-o"></i> Slider</a>
        </li>

        <li class="{{ request()->get('type') == 'partner' ? 'active' : null }}">
            <a href="{{ route('image.index', ['type'=> 'partner']) }}"><i class="fa fa-circle-o"></i> Đối tác</a>
        </li> 
        <li class="{{ Request::segment(2) === 'menu' ? 'active' : null }}">
            <a href="{{ route('setting.menu') }}"><i class="fa fa-circle-o"></i> Menu</a>
        </li>
        
    </ul>
</li>
<div style="display: none;">
	<li class="header">Cấu hình hệ thống</li>
	<li class="treeview {{ Request::segment(2) == 'options' ? 'active' : null  }}">
		<a href="#">
			<i class="fa fa-folder"></i> <span>Setting (Developer)</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ Request::segment(3) == 'developer-config' ? 'active' : null  }}">
				<a href="{{ route('backend.options.developer-config') }}"><i class="fa fa-circle-o"></i> Developer - Config</a>
			</li>
		</ul>
	</li>
</div>