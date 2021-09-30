@section('file_scripts')
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
@endsection

@section('custom_scripts')
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
@endsection
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.fullname') }} :</label>
    <div class="col-lg-9">
        {!! Form::text('fullname', isset($admin) ? $admin->fullname : null, ['class' => 'form-control' , 'placeholder'
        => trans('dash.user_data.fullname')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.mobile') }} :</label>
    <div class="col-lg-9">
        {!! Form::number('mobile', isset($admin) ? $admin->mobile : null, ['class' => 'form-control' , 'placeholder'
        => trans('dash.user_data.mobile')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.email') }} :</label>
    <div class="col-lg-9">
        {!! Form::email('email', isset($admin) ? $admin->email : null, ['class' => 'form-control' , 'placeholder' =>
        trans('dash.user_data.email')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.password') }} :</label>
    <div class="col-lg-9">
        {!! Form::password('password', ['class' => 'form-control' , 'placeholder' => trans('dash.user_data.password')])
        !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.permissions.permissions') }} :</label>
    <div class="col-lg-9">
        {!! Form::select('role_id', $roles, isset($admin) ? $admin->role_id : null, ['class' => 'form-control form-control-select2', 'data-placeholder' => trans('dash.permissions.permissions')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.profile_image') }} :</label>
    <div class="col-lg-9">
        <input type="file" name="avatar" class="form-input-styled" data-fouc>
        <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.status') }} :</label>
    <div class="col-lg-9">
        {!! Form::select('is_active', ['1' => trans('dash.user_data.active_account'), '0' =>
        trans('dash.user_data.deactive_account')], isset($admin) ? $admin->is_active : null, ['class' => 'form-control
        select-search', 'placeholder' => trans('dash.user_data.status')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.banned') }} :</label>
    <div class="col-lg-9">
        {!! Form::select('is_banned', ['0' => trans('dash.user_data.unbanned_account'), '1' =>
        trans('dash.user_data.banned_account')], isset($admin) ? $admin->is_banned : null, ['class' => 'form-control
        select-search', 'placeholder' => trans('dash.user_data.status')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-3">{{ trans('dash.user_data.ban_reason') }}</label>
    <div class="col-lg-9">
        {!! Form::textarea('ban_reason', isset($admin) ? $admin->ban_reason : null, ['class' => 'form-control', 'rows'
        => '5', 'cols' => '5','placeholder' => trans('dash.user_data.ban_reason')]) !!}
    </div>
</div>