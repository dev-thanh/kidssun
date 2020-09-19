<header>
    <div class="header-bar">
        <div class="main-bar">
            <div class="main-sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5">
                            <div class="logo">
                                <a href="{{ url('/') }}" title="Logo">
                                    <img src="{{ @$site_info->logo }}" alt="Logo">
                                </a>
                            </div> <!--logo-->
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-7">
                            <div class="group-block">
                                <div class="group-menu-block">
                                    <div class="megamenu d-none d-lg-block">
                                        <nav class="nav">
                                            @if (!empty($menuHeader))
                                                <ul class="megamenu-content">
                                                    @foreach ($menuHeader as $item)
                                                        @if ($item->parent_id == null)
                                                            <li class="item @if(count($item->get_child_cate())) sub-item @endif {{ $item->class }}">
                                                                <a href="{{ url($item->url) }}" class="@if(count($item->get_child_cate())) sub-title @endif {{ url()->current() == url($item->url) ? 'active' : null }}" 
                                                                    title="{{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}">
                                                                    {{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}
                                                                </a>
                                                                @if (count($item->get_child_cate()))
                                                                    <div class="sub-menu">
                                                                        <ul>
                                                                            @foreach ($item->get_child_cate() as $value)
                                                                                <li>
                                                                                    <a href="{{ url($value->url) }}" class="{{ $value->class }} {{ url($value->url) == url()->current() ? 'active' : null }}"
                                                                                        title="{{ app()->getLocale() == 'vi' ? $value->title : $value->title_en }}">
                                                                                        {{ app()->getLocale() == 'vi' ? $value->title : $value->title_en }}</a>
                                                                                </li>
                                                                            @endforeach	
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    @endforeach	
                                                    <li class="item language">
                                                        <div class="language-box">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('home.change-language', ['lang'=> 'vi']) }}" title="VI" class="language-vi {{ app()->getLocale() == 'vi' ? 'active' : null }}">VI</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('home.change-language', ['lang'=> 'en']) }}" title="EN" class="language-en {{ app()->getLocale() == 'en' ? 'active' : null }}">EN</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>						                         
                                                </ul>
                                            @endif
                                        </nav>
                                    </div> <!--megamenu-->
                                    <div class="megamenu megamenu-mobile d-lg-none">
                                        <div class=-mobile-content>
                                            <button class="menu-open">
                                                <span></span>        
                                            </button>

                                            <div class="modal menu-content">
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <div class="menu-close">
                                                        <span class="close">×</span>
                                                    </div>

                                                    <div class="modal-body">
                                                        <nav class="nav">
                                                            @if (!empty($menuHeader))
                                                                <ul class="megamenu-content">
                                                                    @foreach ($menuHeader as $item)
                                                                        @if ($item->parent_id == null)
                                                                            <li class="item @if(count($item->get_child_cate())) sub-item @endif {{ $item->class }}">
                                                                                <a href="{{ url($item->url) }}" class="@if(count($item->get_child_cate())) sub-title @endif {{ url()->current() == url($item->url) ? 'active' : null }}" 
                                                                                    title="{{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}" class="active">
                                                                                    {{ app()->getLocale() == 'vi' ? $item->title : $item->title_en }}
                                                                                </a>
                                                                                @if (count($item->get_child_cate()))
                                                                                    <div class="sub-menu">
                                                                                        <ul>
                                                                                            @foreach ($item->get_child_cate() as $value)
                                                                                                <li>
                                                                                                    <a href="{{ url($value->url) }}" class="{{ $value->class }} {{ url($value->url) == url()->current() ? 'active' : null }}"
                                                                                                        title="{{ app()->getLocale() == 'vi' ? $value->title : $value->title_en }}">
                                                                                                        {{ app()->getLocale() == 'vi' ? $value->title : $value->title_en }}</a>
                                                                                                </li>
                                                                                            @endforeach	
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif
                                                                            </li>
                                                                        @endif
                                                                    @endforeach		
                                                                    <li class="item language">
                                                                        <div class="language-box">
                                                                            <ul>
                                                                                <li>
                                                                                    <a href="{{ route('home.change-language', ['lang'=> 'vi']) }}" title="VI" class="language-vi {{ app()->getLocale() == 'vi' ? 'active' : null }}">VI</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="{{ route('home.change-language', ['lang'=> 'en']) }}" title="EN" class="language-en {{ app()->getLocale() == 'en' ? 'active' : null }}">EN</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>						                         
                                                                </ul>
                                                            @endif
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- megamenu-mobile -->
                                </div>
                                @if(Auth::guard('customer')->check())
                                    <div class="logined">
                                        <div class="content">
                                            <ul>
                                                <li>
                                                    <span class="title-sub">{{ trans('message.xinchao') }}: {{Auth::guard('customer')->user()->user_name}}</span>
                                                    <div class="sub-menu">
                                                        <ul>
                                                            <li>
                                                                <a href="#">{{ trans('message.capbac') }}: {{ trans('message.dlpp') }}</a>
                                                            </li>
                                                            <li>
                                                                <span>
                                                                    
                                                                <a href="{{ route('home.logout') }}" title="Logout" class="logout">{{ trans('message.thoat') }}</a>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                @else
                                    <div class="login-registration">
                                        <div class="content">
                                            <ul>
                                                <li>
                                                    <a href="#" title="Login" class="login">{{ trans('message.dang_nhap') }}</a>
                                                </li>
                                                <li>
                                                    <a href="#" title="Registration" class="registration">{{ trans('message.dang_ky') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div> <!--main bar-->
    </div> <!--header bar-->
</header> <!--header-->