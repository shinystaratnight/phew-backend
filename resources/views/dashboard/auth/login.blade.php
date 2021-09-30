@extends('dashboard.auth_layout')
@section('file_scripts')
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>	
@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/login.js"></script>
@endsection

@section('content')
<div class="content d-flex justify-content-center align-items-center">
	<!-- Login card -->
	<form class="login-form" method="post" action="{{ route('dashboard.post_login') }}">
		{{ csrf_field() }}
		<div class="card mb-0">			
			<div class="card-body">
				@forelse($errors->all() as $message)
					<div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						{{ $message }}
					</div> 
				@empty
				@endforelse
				@if (session('message') && session('class') )
					<div class="alert alert-{{  session('class') }} alert-styled-left alert-arrow-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						{{ session('message') }}
					</div>
				@endif
				<div class="text-center mb-3">
					<div class="icon-object border-slate-300 text-slate-300"><img src="{{ asset('assets/global') }}/images/logos/logo-icon.png" style="width: 60px; height: 60px"></div>
					<h5 class="mb-0">{{ trans('dash.auth.login') }}</h5>
					<span class="d-block text-muted">{{ settings('dashboard_name_' . app()->getLocale()) }}</span>
				</div>
				<div class="form-group form-group-feedback form-group-feedback-left">
					<input type="email" class="form-control" placeholder="{{ trans('dash.auth.email') }}" name="username" required="required">
					<div class="form-control-feedback">
						<i class="icon-user text-muted"></i>
					</div>
				</div>
				<div class="form-group form-group-feedback form-group-feedback-left">
					<input type="password" class="form-control" placeholder="{{ trans('dash.auth.password') }}" name="password" required="required">
					<div class="form-control-feedback">
						<i class="icon-lock2 text-muted"></i>
					</div>
				</div>
				<div class="form-group d-flex align-items-center">
					<div class="form-check mb-0">
						<label class="form-check-label">
							<input type="checkbox" name="remember" class="form-input-styled" checked data-fouc> {{ trans('dash.auth.remember_me') }}
						</label>
					</div>
					<a href="{{ route('password.reset') }}" class="ml-auto">{{ trans('dash.auth.forgot_password') }}</a>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">{{ trans('dash.auth.login') }}
						<i class="{{app()->getLocale() == 'ar' ? 'icon-circle-left2' : 'icon-circle-right2'}} ml-2"></i>
					</button>
				</div>				
			</div>
		</div>
	</form>
	<!-- /login card -->
</div>
@endsection