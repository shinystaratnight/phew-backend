@section('file_scripts')
<script src="{{ asset('assets/global') }}/js/plugins/forms/wizards/steps.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>

<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switchery.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switch.min.js"></script>

<script src="{{ asset('assets/global') }}/js/plugins/forms/inputs/inputmask.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/validation/validate.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/extensions/cookie.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

@endsection

@section('custom_scripts')
<script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
@if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
<script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard_rtl.js"></script>
@else
<script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard.js"></script>
@endif
<script src="{{ asset('assets/global') }}/js/demo_pages/form_inputs.js"></script>
<script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
<script src="{{ asset('assets/global') }}/js/demo_pages/form_checkboxes_radios.js"></script>
<script src="{{ asset('assets/global') }}/js/demo_pages/form_multiselect.js"></script>
@endsection

@foreach (config('translatable.locales') as $locale)
{{-- <h6>{{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6> --}}
<fieldset class="content-group">
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.'.$locale.'.name') }} :</label>
        <div class="col-lg-10">
            {!! Form::text($locale."[name]", isset($package) ? $package->translate($locale)->name : null, ['class' =>
            'form-control' , 'placeholder' => trans('dash.'.$locale.'.name')]) !!}
        </div>
    </div>
</fieldset>
@endforeach
{{-- <h6>{{ trans('dash.form.public_data') }}</h6> --}}
<fieldset>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.package.period') }} :</label>
        <div class="col-lg-10">
            {!! Form::text('period', isset($package) ? $package->period : null, ['class' => 'form-control' ,
            'placeholder' => trans('dash.package.period')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.package.period_type') }} :</label>
        <div class="col-lg-10">
            {!! Form::select('period_type', [
            'hours' => trans('dash.package.period_types.hours'),
            'days' => trans('dash.package.period_types.days'),
            'weeks' => trans('dash.package.period_types.weeks'),
            'months' => trans('dash.package.period_types.months'),
            'years' => trans('dash.package.period_types.years'),
            ], null, ['class' => 'form-control select-search' , 'placeholder' => trans('dash.package.period_type')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.package.package_type') }} :</label>
        <div class="col-lg-10">
            {!! Form::select('package_type', ['free' => trans('dash.package.free_package'), 'paid'
            => trans('dash.package.paid_package')],
            isset($package) ? $package->package_type : null, ['class' => 'form-control select-search']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.package.price') }} :</label>
        <div class="col-lg-10">
            {!! Form::text('price', isset($package) ? $package->price : null, ['class' => 'form-control' , 'placeholder' => trans('dash.package.price')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <legend class="font-weight-semibold text-uppercase font-size-sm">{{ trans('dash.package.plan') }}</legend>
        @foreach (array_chunk(trans('dash.package.plans'), 2, true) as $chunk)
            @foreach ($chunk as $key => $value)
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-6">{{ $value }} :</label>
                        <div class="col-lg-6">
                            <div class="input-group">
                                {!! Form::text('plan[' . $key . ']', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
        @endforeach
    </div>
</fieldset>
<legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
<div class="text-right">
    <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
</div>