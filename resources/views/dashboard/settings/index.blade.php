@extends('dashboard.layout')
@section('file_scripts')
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
    
@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_checkboxes_radios.js"></script>
@endsection
@section('page_title')
    {{ trans('dash.settings.settings') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.settings.settings') }}</span>
@endsection
@section('content')
<!-- Vertical form options -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.settings.general_settings') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.setting.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.dashboard_name_ar') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="dashboard_name_ar" value="{{ settings('dashboard_name_ar') }}" class="form-control" placeholder="{{ trans('dash.settings.dashboard_name_ar') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.dashboard_name_en') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="dashboard_name_en" value="{{ settings('dashboard_name_en') }}" class="form-control" placeholder="{{ trans('dash.settings.dashboard_name_en') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.mobile') }} :</label>
                        <div class="col-lg-8">
                            <input type="phone" name="mobile" value="{{ settings('mobile') }}" class="form-control" placeholder="{{ trans('dash.settings.mobile') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.email') }} :</label>
                        <div class="col-lg-8">
                            <input type="email" name="email" value="{{ settings('email') }}" class="form-control" placeholder="{{ trans('dash.settings.email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.copy_write_ar') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="copy_write_ar" value="{{ settings('copy_write_ar') }}" class="form-control" placeholder="{{ trans('dash.settings.copy_write_ar') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.copy_write_en') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="copy_write_en" value="{{ settings('copy_write_en') }}" class="form-control" placeholder="{{ trans('dash.settings.copy_write_en') }}">
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.settings.social_settings') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.setting.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.facebook_url') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="facebook_url" value="{{ settings('facebook_url') }}" class="form-control" placeholder="{{ trans('dash.settings.facebook_url') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.twitter_url') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="twitter_url" value="{{ settings('twitter_url') }}" class="form-control" placeholder="{{ trans('dash.settings.twitter_url') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.youtube_url') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="youtube_url" value="{{ settings('youtube_url') }}" class="form-control" placeholder="{{ trans('dash.settings.youtube_url') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.instagram_url') }} :</label>
                        <div class="col-lg-8">
                            <input type="text" name="instagram_url" value="{{ settings('instagram_url') }}" class="form-control" placeholder="{{ trans('dash.settings.instagram_url') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{ trans('dash.settings.whatsapp_phone') }} :</label>
                        <div class="col-lg-8">
                            <input type="phone" name="whatsapp_phone" value="{{ settings('whatsapp_phone') }}" class="form-control" placeholder="{{ trans('dash.settings.whatsapp_phone') }}">
                        </div>
                    </div>
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.settings.about_app_settings') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.setting.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.settings.about_ar') }} :</label>
                        <div class="col-lg-9">
                            <textarea rows="5" cols="5" name="about_ar" class="form-control" placeholder="{{ trans('dash.settings.about_ar') }}">{{ settings('about_ar') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.settings.about_en') }} :</label>
                        <div class="col-lg-9">
                            <textarea rows="5" cols="5" name="about_en" class="form-control" placeholder="{{ trans('dash.settings.about_en') }}">{{ settings('about_en') }}</textarea>
                        </div>
                    </div>
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.settings.conditions_app_settings') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.setting.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.settings.conditions_terms_ar') }} :</label>
                        <div class="col-lg-9">
                            <textarea rows="5" cols="5" name="conditions_terms_ar" class="form-control" placeholder="{{ trans('dash.settings.conditions_terms_ar') }}">{{ settings('conditions_terms_ar') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.settings.conditions_terms_en') }} :</label>
                        <div class="col-lg-9">
                            <textarea rows="5" cols="5" name="conditions_terms_en" class="form-control" placeholder="{{ trans('dash.settings.conditions_terms_en') }}">{{ settings('conditions_terms_en') }}</textarea>
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
@endsection