@section('file_scripts')
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/wizards/steps.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>

	<script src="{{ asset('assets/global') }}/js/plugins/forms/inputs/inputmask.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/validation/validate.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/extensions/cookie.js"></script>

@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard_rtl.js"></script>
    @else
        <script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard.js"></script>
    @endif
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_inputs.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
@endsection
@foreach (config('translatable.locales') as $locale)
	{{-- <h6>{{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6> --}}
	<fieldset class="content-group">
		<div class="form-group row">
            <label class="col-form-label col-lg-3">{{ trans('dash.'.$locale.'.name') }} :</label>
            <div class="col-lg-9">
                {!! Form::text($locale."[name]", isset($country) ? $country->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dash.'.$locale.'.name')]) !!}
            </div>
        </div>
		<div class="form-group row">
            <label class="col-form-label col-lg-3">{{ trans('dash.'.$locale.'.currency') }} :</label>
            <div class="col-lg-9">
                {!! Form::text($locale."[currency]", isset($country) ? $country->translate($locale)->currency : null, ['class' => 'form-control' , 'placeholder' => trans('dash.'.$locale.'.currency')]) !!}
            </div>
        </div>
	</fieldset>
@endforeach
{{-- <h6>{{ trans('dash.form.public_data') }}</h6> --}}
<fieldset>
    <div class="form-group row">
        <label class="col-form-label col-lg-3">{{ trans('dash.country.in_findly') }} :</label>
        <div class="col-lg-9">
            {!! Form::select('in_findly', ['1' => trans('dash.country.confirmed'), '0' => trans('dash.country.not_confirmed')], isset($country) ? $country->in_findly : null, ['class' => 'form-control select-search', 'placeholder' => trans('dash.country.in_findly')]) !!}
        </div>
    </div>
	<div class="form-group row">
        <label class="col-form-label col-lg-3">{{ trans('dash.country.short_name') }} :</label>
        <div class="col-lg-9">
            {!! Form::text('short_name', isset($country) ? $country->short_name : null, ['class' => 'form-control' , 'placeholder' => trans('dash.country.short_name')]) !!}
        </div>
    </div>
	<div class="form-group row">
        <label class="col-form-label col-lg-3">{{ trans('dash.country.show_phonecode') }} :</label>
        <div class="col-lg-9">
            {!! Form::text('show_phonecode', isset($country) ? $country->show_phonecode : null, ['class' => 'form-control' , 'placeholder' => trans('dash.country.show_phonecode')]) !!}
        </div>
    </div>
	<div class="form-group row">
        <label class="col-form-label col-lg-3">{{ trans('dash.country.phonecode') }} :</label>
        <div class="col-lg-9">
            {!! Form::text('phonecode', isset($country) ? $country->phonecode : null, ['class' => 'form-control' , 'placeholder' => trans('dash.country.phonecode')]) !!}
        </div>
    </div>
	<div class="form-group row">
        <label class="col-form-label col-lg-3">{{ trans('dash.country.flag') }} :</label>
        <div class="col-lg-9">
            <input name="flag" type="file" class="form-control-uniform-custom" >
        </div>
    </div>
</fieldset>
<legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
<div class="text-right">
    <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
</div>