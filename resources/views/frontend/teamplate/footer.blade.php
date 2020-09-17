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
</footer> <!--footer-->