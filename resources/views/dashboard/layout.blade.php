<!DOCTYPE html>
<html lang="en" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
	@include('dashboard.parts.meta')
	<title>{{ settings('dashboard_name_' . app()->getLocale()) }} - @yield('page_title')</title>
	@include('dashboard.parts.styles')
	@yield('style')
	@include('dashboard.parts.scripts')
</head>
<body>
	@include('dashboard.parts.navbar')
	<!-- Page content -->
	<div class="page-content">
		@include('dashboard.parts.sidebar')
		<!-- Main content -->
		{{--  @include('dashboard.parts.alert_messages')  --}}
		<div class="content-wrapper">
			@include('dashboard.parts.page_header')
			<!-- Content area -->
    		<div class="content">
				<div class="loading"> 
					<div class="con" style="padding-top: 80px">
						<h4><img src="{{ asset('assets/global') }}/images/logos/logo_loading.png" style="width: 280px;"></h4>
						<h3>{{ trans('dash.messages.please_wait') }}</h3>
						<img src="{{ asset('assets/global') }}/images/loading.gif" style="width: 50px;">
					</div>
				</div>	
				<div class="loading-page">
					@foreach($errors->all() as $message)
					<div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						{{ $message }}
					</div>
					@endforeach
					@if (session('message') && session('class') )
						<div class="alert alert-{{  session('class') }} alert-styled-left alert-arrow-left alert-dismissible">
							<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
							{{ session('message') }}
						</div>
					@endif
					@yield('content')
				</div>							
			</div>
    		<!-- /content area -->
			@include('dashboard.parts.footer')		
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>