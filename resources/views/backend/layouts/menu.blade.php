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
            <a href="{{ route('images.index', ['type'=> 'slider']) }}"><i class="fa fa-circle-o"></i> Slider</a>
        </li>

        <li class="{{ request()->get('type') == 'partner' ? 'active' : null }}">
            <a href="{{ route('images.index', ['type'=> 'partner']) }}"><i class="fa fa-circle-o"></i> Đối tác</a>
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