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
	<form class="login-form" action="{{ route('password.reset.new_password', $token) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="token" class="form-control" value="{{ $token }}">
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
				@if (session('status'))
					<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						{{ session('status') }}
					</div>
				@endif
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-primary border-primary border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">{{ trans('dash.auth.passwords.reset_password') }}</h5>
                    <span class="d-block text-muted">{{ trans('dash.auth.passwords.please_write_a_new_password') }}</span>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="email" name="email" class="form-control" placeholder="{{ trans('dash.auth.passwords.your_email') }}">
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" name="password" class="form-control" placeholder="{{ trans('dash.auth.passwords.new_password') }}">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('dash.auth.passwords.password_confirmation') }}">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <button type="submit" class="btn bg-blue btn-block"><i class="icon-spinner11 mr-2"></i>{{ trans('dash.auth.passwords.reset_password') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection