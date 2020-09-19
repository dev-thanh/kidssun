<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{ $site_info->favicon }}">
	@if (isset($site_info->index_google))
		<meta name="robots" content="{{ $site_info->index_google == 1 ? 'index, follow' : 'noindex, nofollow' }}">
	@else
		<meta name="robots" content="noindex, nofollow">
	@endif
	{!! SEO::generate() !!}
	<meta name='revisit-after' content='1 days' />
	<meta name="copyright" content="GCO" />
	<meta http-equiv="content-language" content="vi" />
	<meta name="geo.region" content="VN" />
    <meta name="geo.position" content="10.764338, 106.69208" />
    <meta name="geo.placename" content="Hà Nội" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
 	<meta name="_token" content="{{csrf_token()}}" />
 	<link rel="canonical" href="{{ \Request::fullUrl() }}">


	 <!--link css-->

	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	 
	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/mobilemenu.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/all.fontawesome.min.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/toastr.min.css">
	
	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/styles.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/reponsive.css">

	<script type="text/javascript" src="{{ __BASE_URL__ }}/js/jquery.min.js"></script> 
 	

 	@if (!empty($site_info->google_analytics))
 		{!! $site_info->google_analytics !!}
 	@endif

</head> 
	<body>

		<div class="loadingcover" style="display: none;">
		    <p class="csslder">
		        <span class="csswrap">
		            <span class="cssdot"></span>
		            <span class="cssdot"></span>
		            <span class="cssdot"></span>
		        </span>
		    </p>
		</div>

		<div class="breadcrumbs" style="display: none;">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="title-box breadcrumbs-title">
							<h1 class="title">Kidssunvn</h1>
						</div>
					</div>
				</div>
			</div>
		</div> <!--breadcrumbs-->

		@include('frontend.teamplate.header')
			<main class="main-site">
				@yield('main')
			</main>

		@include('frontend.teamplate.footer')

		<div class="chatbot-box">
			<div class="chatbot-mxh">
				<ul>
					<li class="chatbot-hotline">
						<a href="tel:{{ @$site_info->hotline }}" title="{{ @$site_info->hotline }}"><img src="{{ url('/') }}/public/frontend/images/pop-icon-phone.png" alt="chatbot"></a>
					</li>
					<li class="chatbot-mail">
						<a href="{{ @$site_info->link_mail }}"><img src="{{ url('/') }}/public/frontend/images/pop-icon-mail.png" alt="chatbot"></a>
					</li>
					<li class="chatbot-face">
						<a href="{{ @$site_info->link_facebook }}"><img src="{{ url('/') }}/public/frontend/images/pop-icon-face.png" alt="chatbot"></a>
					</li>
				</ul>
			</div>
		</div>
		

		<!--Link js-->
		
		

		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/slick.min.js"></script> 

		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/mobilemenu.js"></script>

		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>

		<script type="text/javascript" src="{{ __BASE_URL__ }}/js/main.js"></script>

		<div class="popup popup-images">
			<div class="popup-content">
				<div class="popup-close">
					<i class="fal fa-times icon icon-close"></i>
				</div>
				<div class="popup-images-box popup-box">
					<div class="popup-banner-image">
						<img src="{{ @$site_info->logo }}" alt="image">
					</div>
				</div>
			</div>
		</div>
		

		@yield('script')
		@if (!empty($site_info->script))
			{!! $site_info->script !!}
		@endif

		<script>
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				toastr.options = {
					"closeButton": false,
					"debug": false,
					"newestOnTop": false,
					"progressBar": false,
					"positionClass": "toast-top-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				}
			});
		</script>
		
		@if(Session::has('message'))
			<script type='text/javascript'>
				toastr["{!! Session::get('level') !!}"]("{!! Session::get('message') !!}")
			</script>
     	@endif
     	@if(Session::has('success'))
		<script type="text/javascript">
			$(document).ready(function($) {
				toastr["success"]('{{ Session::get('success') }}', "Thông báo");
			});
		</script>
	@endif
	</body>
</html>