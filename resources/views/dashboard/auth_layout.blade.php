<!DOCTYPE html>
<html lang="en" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ settings('dashboard_name_' . app()->getLocale()) }}</title>

	@include('dashboard.parts.styles')
	@yield('style')
	@include('dashboard.parts.scripts')	
	
</head>
<body class="bg-slate-800" style="background-image: url({{ asset('assets/global') }}/images/backgrounds/user_bg1.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			@yield('content')
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>