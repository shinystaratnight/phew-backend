@section('file_scripts')
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>

    <script src="{{ asset('assets/global') }}/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/anytime.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/pickadate/legacy.js"></script>
@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <script src="{{ asset('assets/global') }}/js/demo_pages/picker_date_rtl.js"></script>
    @else
        <script src="{{ asset('assets/global') }}/js/demo_pages/picker_date.js"></script>
    @endif
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_inputs.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
@endsection

<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.fullname') }} :</label>
    <div class="col-lg-10">
        {!! Form::text('fullname', isset($client) ? $client->fullname : null, ['class' => 'form-control' , 'placeholder' => trans('dash.user_data.fullname')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.username') }} :</label>
    <div class="col-lg-10">
        {!! Form::text('username', isset($client) ? $client->username : null, ['class' => 'form-control' , 'placeholder' => trans('dash.user_data.username')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.mobile') }} :</label>
    <div class="col-lg-10">
        {!! Form::number('mobile', isset($client) ? $client->mobile : null, ['class' => 'form-control' , 'placeholder' => trans('dash.user_data.mobile')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.email') }} :</label>
    <div class="col-lg-10">
        {!! Form::email('email', isset($client) ? $client->email : null, ['class' => 'form-control' , 'placeholder' => trans('dash.user_data.email')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.password') }} :</label>
    <div class="col-lg-10">
        {!! Form::password('password', ['class' => 'form-control' , 'placeholder' => trans('dash.user_data.password')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.profile_image') }} :</label>
    <div class="col-lg-10">
        <input type="file" name="avatar" class="form-control-uniform-custom" data-fouc>
        <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.country.countries') }} :</label>
    <div class="col-lg-10">
        <select name="city_id" data-placeholder="{{ trans('dash.country.country') }}" class="form-control select-search" data-fouc>
            @foreach($countries as $country)
                <optgroup label="{{ $country->name }}">
                    @foreach($country->cities as $city)
                        @if(isset($client) && $city->id == $client->city_id)
                            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                        @else
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endif
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.package.package') }} :</label>
    <div class="col-lg-10">
        {!! Form::select('package_id', $packages ?? '', null, ['class' => 'form-control select-search', 'placeholder' => trans('dash.package.package')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.date_of_birth') }} :</label>
    <div class="col-lg-10">
        {!! Form::text('date_of_birth', isset($client) ? date('m/d/Y', strtotime($client->date_of_birth)) : null, ['class' => 'form-control daterange-single' , 'placeholder' => trans('dash.user_data.date_of_birth')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.gender') }} :</label>
    <div class="col-lg-10">
        {!! Form::select('gender', ['male' => trans('dash.clients.male'), 'female' => trans('dash.clients.female')], isset($client) ? $client->gender : null, ['class' => 'form-control select-search', 'placeholder' => trans('dash.user_data.gender')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.status') }} :</label>
    <div class="col-lg-10">
        {!! Form::select('is_active', ['1' => trans('dash.user_data.active_account'), '0' => trans('dash.user_data.deactive_account')], isset($client) ? $client->is_active : null, ['class' => 'form-control select-search', 'placeholder' => trans('dash.user_data.status')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.banned') }} :</label>
    <div class="col-lg-10">
        {!! Form::select('is_banned', ['0' => trans('dash.user_data.unbanned_account'), '1' => trans('dash.user_data.banned_account')], isset($client) ? $client->is_banned : null, ['class' => 'form-control select-search', 'placeholder' => trans('dash.user_data.status')]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label col-lg-2">{{ trans('dash.user_data.ban_reason') }}</label>
    <div class="col-lg-10">
        {!! Form::textarea('ban_reason', isset($client) ? $client->ban_reason : null, ['class' => 'form-control', 'rows' => '5', 'cols' => '5','placeholder' => trans('dash.user_data.ban_reason')]) !!}
    </div>
</div>
<legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
<div class="text-right">
    <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
</div>
