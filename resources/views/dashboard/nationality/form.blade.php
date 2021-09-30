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
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard_rtl.js"></script>
    @else
        <script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard.js"></script>
    @endif
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_inputs.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
@endsection
@foreach (config('translatable.locales') as $locale)
	{{-- <h6>{{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}</h6> --}}
	<fieldset class="content-group">
		<div class="form-group row">
            <label class="col-form-label col-lg-3">{{ trans('dash.'.$locale.'.name') }} :</label>
            <div class="col-lg-9">
                {!! Form::text($locale."[name]", isset($nationality) ? $nationality->translate($locale)->name : null, ['class' => 'form-control' , 'placeholder' => trans('dash.'.$locale.'.name')]) !!}
            </div>
        </div>
	</fieldset>
@endforeach
<legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
<div class="text-right">
    <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
</div>