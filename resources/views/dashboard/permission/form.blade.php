@foreach (config('translatable.locales') as $locale)
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.'.$locale.'.name') }} :</label>
    <div class="col-lg-10">
        {!! Form::text($locale."[name]", isset($role) ? $role->translate($locale)->name : null, ['class' => 'form-control'
        , 'placeholder' => trans('dash.'.$locale.'.name')]) !!}
    </div>
</div>
@endforeach
<legend class="font-weight-semibold text-uppercase font-size-sm">{{ trans('dash.permissions.permissions') }}</legend>
{{--  permissions  --}}
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.permissions.permissions') }} :</label>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.permission.index"
                            @if(isset($role) && in_array('dashboard.permission.index', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.view_list') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.permission.create"
                            @if(isset($role) && in_array('dashboard.permission.create', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.create') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.permission.store"
                        @if(isset($role) && in_array('dashboard.permission.store', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.permission.edit"
                            @if(isset($role) && in_array('dashboard.permission.edit', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.edit') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.permission.update"
                        @if(isset($role) && in_array('dashboard.permission.update', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.permission.destroy"
                            @if(isset($role) && in_array('dashboard.permission.destroy', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.delete') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline"></div>
            </div>
        </div>
    </div>
</div>
{{--  admins  --}}
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.admins.admins') }} :</label>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.admin.index"
                            @if(isset($role) && in_array('dashboard.admin.index', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.view_list') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.admin.create"
                            @if(isset($role) && in_array('dashboard.admin.create', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.create') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.admin.store"
                        @if(isset($role) && in_array('dashboard.admin.store', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.admin.edit"
                            @if(isset($role) && in_array('dashboard.admin.edit', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.edit') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.admin.update"
                        @if(isset($role) && in_array('dashboard.admin.update', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.admin.destroy"
                            @if(isset($role) && in_array('dashboard.admin.destroy', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.delete') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg"></div>
        </div>
    </div>
</div>
{{--  clients  --}}
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.client.clients') }} :</label>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.client.index"
                            @if(isset($role) && in_array('dashboard.client.index', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.view_list') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.client.create"
                            @if(isset($role) && in_array('dashboard.client.create', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.create') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.client.store"
                        @if(isset($role) && in_array('dashboard.client.store', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.client.edit"
                            @if(isset($role) && in_array('dashboard.client.edit', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.edit') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.client.update"
                        @if(isset($role) && in_array('dashboard.client.update', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.client.destroy"
                            @if(isset($role) && in_array('dashboard.client.destroy', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.delete') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.client.show"
                            @if(isset($role) && in_array('dashboard.client.show', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.show_details') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  countries  --}}
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.country.countries') }} :</label>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.country.index"
                            @if(isset($role) && in_array('dashboard.country.index', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.view_list') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.country.create"
                            @if(isset($role) && in_array('dashboard.country.create', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.create') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.country.store"
                        @if(isset($role) && in_array('dashboard.country.store', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.country.edit"
                            @if(isset($role) && in_array('dashboard.country.edit', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.edit') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.country.update"
                        @if(isset($role) && in_array('dashboard.country.update', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.country.destroy"
                            @if(isset($role) && in_array('dashboard.country.destroy', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.delete') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg"></div>
        </div>
    </div>
</div>
{{--  cities  --}}
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.city.cities') }} :</label>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.city.index"
                            @if(isset($role) && in_array('dashboard.city.index', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.view_list') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.city.create"
                            @if(isset($role) && in_array('dashboard.city.create', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.create') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.city.store"
                        @if(isset($role) && in_array('dashboard.city.store', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.city.edit"
                            @if(isset($role) && in_array('dashboard.city.edit', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.edit') }}
                    </label>
                    <input type="checkbox" name="roles[]" value="dashboard.city.update"
                        @if(isset($role) && in_array('dashboard.city.update', $role->plan)) checked @endif hidden>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="form-check form-check-switchery form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="roles[]" value="dashboard.city.destroy"
                            @if(isset($role) &&in_array('dashboard.city.destroy', $role->plan)) checked @endif
                        class="form-check-input-switchery" data-fouc>
                        {{ trans('dash.permissions.roles.delete') }}
                    </label>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg"></div>
        </div>
    </div>
</div>
<legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
<div class="text-right">
    <a href="{{ route('dashboard.permission.index') }}" class="btn btn-primary text-white"><i
            class="icon-list2 mr-2"></i>{{ trans('dash.buttons.back_to_list') }}</a>
    <button type="reset" class="btn btn-light"><i
            class="icon-reset mr-2"></i>{{ trans('dash.buttons.reset_data') }}</button>
    <button type="submit" class="btn btn-success submit_form_btn"><i
            class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
</div>