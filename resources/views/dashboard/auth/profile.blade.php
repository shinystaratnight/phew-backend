@extends('dashboard.layout')
@section('file_scripts')
    <script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>	
@endsection
@section('page_title')
{{ trans('dash.sidebar.my_profile') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.sidebar.my_profile') }}</span>
@endsection
@section('content')
<!-- Vertical form options -->
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.user_data.my_info') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.update.profile') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.fullname') }} :</label>
                        <div class="col-lg-9">
                            <input type="text" name="fullname" value="{{ auth()->user()->fullname }}" class="form-control" placeholder="{{ trans('dash.user_data.fullname') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.mobile') }} :</label>
                        <div class="col-lg-9">
                            <input type="number" name="mobile" value="{{ auth()->user()->mobile }}" class="form-control" placeholder="{{ trans('dash.user_data.mobile') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.email') }} :</label>
                        <div class="col-lg-9">
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" placeholder="{{ trans('dash.user_data.email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.profile_image') }} :</label>
                        <div class="media mt-0 col-lg-9">
                            <div class="media-body">
                                <input type="file" name="avatar" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.user_data.change_password') }}</h5>                        
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.update.password') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.old_password') }} :</label>
                        <div class="col-lg-9">
                            <input type="password" name="old_password" class="form-control" placeholder="{{ trans('dash.user_data.old_password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.new_password') }} :</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('dash.user_data.new_password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.user_data.password_confirmation') }} :</label>
                        <div class="col-lg-9">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('dash.user_data.password_confirmation') }}">
                        </div>
                    </div>
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /vertical form options -->
@endsection