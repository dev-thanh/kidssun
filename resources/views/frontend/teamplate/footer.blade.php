<footer>
	<div class="footer-main">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12">
					<div class="footer-box">
						<div class="footer-logo">
							<div class="logo">
								<a href="{{ url('/') }}" title="Logo">
									<img src="{{ @$site_info->logo }}" alt="Logo">
								</a>
								<p>
									{{ app()->getLocale() == 'vi' ? @$site_info->name_company : @$site_info->name_company_en }}
								</p>
							</div>
						</div>

						<div class="footer-menu">
							<div class="footer-title title-box">
								<h3 class="title">
									<span>Hotline</span>
								</h3>
							</div>
							<div class="footer-hotline">
								<ul>
									<li>
										<a href="{{ @$site_info->link_facebook }}" title="Facebook">
											<img src="{{ url('/') }}/public/frontend/images/hotline-face.png" alt="Facebook">
										</a>
									</li>
									<li>
										<a href="{{ @$site_info->link_youtube }}" title="Youtube">
											<img src="{{ url('/') }}/public/frontend/images/hotline-yout.png" alt="Youtube">
										</a>
									</li>
								</ul>
							</div>
						</div>							
					</div> <!--footer box-->
				</div>

				<div class="col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12">
					<div class="footer-box">
						<div class="footer-menu">
							<div class="footer-title title-box footer-contact-title">
								<h3 class="title">
									<span>{{ trans('message.thong_tin_lien_he') }}</span>
								</h3>
							</div>
							<div class="footer-contact">
								<ul>
									<li>
										<i class="fas fa-map-marker-alt icon icon-map"></i>
										<p>{{ app()->getLocale() == 'vi' ? @$site_info->address : @$site_info->address_en }}</p>
									</li>
									<li>
										<i class="fas fa-phone-alt icon icon-phone"></i>
										<p>{{ @$site_info->hotline }} - {{ @$site_info->hotline2 }}</p>
									</li>
									<li>
										<i class="fas fa-envelope icon icon-mail"></i>
										<p>{{ @$site_info->email }}</p>
									</li>
								</ul>
							</div>
						</div>							
					</div> <!--footer box-->
				</div>
			</div>
		</div>		
	</div> <!--footer main-->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="copyright-box">
						<p>{{ @$site_info->copyright }}</p>
					</div>
				</div>
			</div>
		</div>
	</div> <!--footer bottom-->
	<div class="art-popups art-popups-login-registration">
        <div class="popups-box">
            <div class="popups-content">
                <div class="popup-content-login active">
                    <div class="title-box title-popup">
                        <h3 class="title"><span>{{ trans('message.dang_nhap') }}</span></h3>
                    </div>
                    <div class="popup-content">
                        <form class="forms" method="POST" id="form-login" action="{{route('home.post-login')}}">
                        	@csrf
                            <div class="form-content">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name_email" placeholder="{{ trans('message.tendangngap_email') }}">
                                    <span class="eror-ms name_email-error"></span>
                                </div>  
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password_login" placeholder="{{ trans('message.mat_khau') }}">
                                    <span class="eror-ms password_login-error"></span>
                                </div>

                                <div class="form-group">
                                    <div class="button">
                                        <div class="login-registration">
                                            <ul>
                                                <!-- <li>
                                                    <a href="#" class="registration">Đăng ký</a>
                                                </li> -->
                                                <li>
                                                    <a href="#" class="forgot-password title-popup">{{trans('message.quen_mat_khau') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>                      
                                        <button class="btn btn-login-member">{{ trans('message.dang_nhap') }}</button>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="popup-content-registration">
                    <div class="title-box title-popup">
                        <h3 class="title"><span>{{ trans('message.dang_ky') }}</span></h3>
                    </div>
                    <div class="popup-content">
                        <form id="register-member" method="POST" action="{{route('home.post-member')}}" class="forms">
                        	@csrf
                            <div class="form-content">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="full_name" placeholder="{{ trans('message.ho_ten') }}">
                                    <span class="full_name-error eror-ms"></span>
                                </div>  
                                <div class="form-group">
                                    <input class="form-control" type="text" name="user_name" placeholder="{{ trans('message.ten_dang_nhap') }}">
                                    <span class="user_name-error eror-ms"></span>
                                </div>  
                                <div class="form-group form-no-input">
                                    <input class="form-control" type="text" name="mentor_code" value="{{@$magioithieu}}">
                                    <span class="mentor_code-error eror-ms"></span>
                                </div>  
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email" placeholder="{{ trans('message.email') }}">
                                    <span class="email-error eror-ms"></span>
                                </div>  
                                <div class="form-group">
                                    <input class="form-control" type="text" name="phone" placeholder="{{ trans('message.so_dien_thoai') }}">
                                    <span class="phone-error eror-ms"></span>
                                </div>  
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="{{ trans('message.mat_khau') }}">
                                    <span class="password-error eror-ms"></span>
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control" value="" id="password_confirmation" placeholder="{{ trans('message.nhap_lai_mk') }}" />
                                    <span class="password_confirmation-error eror-ms"></span>
                                </div>

                                <div class="form-group">
                                    <div class="button">
                                        <div class="login-registration">
                                            <ul>
                                                <li>
                                                    <a href="#" class="login title-popup">{{ trans('message.dang_nhap') }}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="forgot-password title-popup">{{ trans('message.quen_mat_khau') }}</a>
                                                </li>
                                            </ul>
                                        </div>                      
                                        <button class="btn btn-register-member">{{ trans('message.dang_ky') }}</button>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="popup-content-forgot-password">
                    <div class="title-box title-popup">
                        <h3 class="title"><span>{{trans('message.quen_mat_khau') }}</span></h3>
                    </div>
                    <div class="popup-content">
                        <form class="forms" id="reset-pass-member" method="POST" action="{{route('home.quen-mat-khau')}}">
                        	@csrf
                            <div class="form-content">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email_reset" placeholder="{{ trans('message.email_dangki') }}">
                                    <span class="email_reset-error eror-ms"></span>
                                </div>  

                                <div class="form-group">
                                    <div class="button">
                                        <div class="login-registration">
                                            <ul>
                                                <li>
                                                    <a href="#" class="login title-popup">{{ trans('message.dang_nhap') }}</a>
                                                </li>
                                                <!-- <li>
                                                    <a href="#" class="registration">Đăng ký</a>
                                                </li> -->
                                            </ul>
                                        </div>                      
                                        <button class="btn btn-reset-password">{{ trans('message.gui') }}</button>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> <!--footer-->