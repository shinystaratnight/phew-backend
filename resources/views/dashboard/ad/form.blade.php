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

    <script src="{{ asset('assets/global') }}/js/plugins/ui/moment/moment.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/pickers/daterangepicker.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/pickers/pickadate/picker.date.js"></script>

@endsection

@section('custom_scripts')
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard_rtl.js"></script>
        <script src="{{ asset('assets/global') }}/js/demo_pages/picker_date_rtl.js"></script>
    @else
        <script src="{{ asset('assets/global') }}/js/demo_pages/form_wizard.js"></script>
        <script src="{{ asset('assets/global') }}/js/demo_pages/picker_date.js"></script>
    @endif
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_inputs.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_checkboxes_radios.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_multiselect.js"></script>

@endsection
{{-- <h6>{{ trans('dash.form.public_data') }}</h6> --}}
{{-- <fieldset> --}}
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.ad.ad_type') }} :</label>
        <div class="col-lg-10">
            {!! Form::select('file_type', ['image' => trans('dash.ad.image'), 'video' => trans('dash.ad.video')], isset($ad) ? $ad->image->option : null, ['class' => 'form-control select-search', 'placeholder' => trans('dash.ad.ad_type')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.ad.ad') }} :</label>
        <div class="col-lg-10">
            <input type="file" name="file" class="form-control-uniform-custom" data-fouc>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.sponsor.sponsors') }} :</label>
        <div class="col-lg-10">
            {!! Form::select('sponsor_id', $sponsors, isset($ad) ? $ad->sponsor_id : null, ['class' => 'form-control select-search' , 'placeholder' => trans('dash.sponsor.sponsors')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.ad.start_date') }} :</label>
        <div class="col-lg-10">
            {!! Form::text('start_date', isset($ad) ? date('m/d/Y', strtotime($ad->start_date)) : now()->format('m/d/Y'), ['class' => 'form-control daterange-single', 'min' => now()->format('m/d/Y')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.ad.end_date') }} :</label>
        <div class="col-lg-10">
            {!! Form::text('end_date', isset($ad) ? date('m/d/Y', strtotime($ad->end_date)) : now()->format('m/d/Y'), ['class' => 'form-control daterange-single' , 'placeholder' => trans('dash.ad.end_date')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.ad.visit_ad') }} :</label>
        <div class="col-lg-10">
            {!! Form::text('url', isset($ad) ? $ad->url : null, ['class' => 'form-control' , 'placeholder' => trans('dash.ad.visit_ad')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-2">{{ trans('dash.ad.desc') }} :</label>
        <div class="col-lg-10">
            {!! Form::textarea('desc', isset($ad) ? $ad->desc : null, ['class' => 'form-control' , 'placeholder' => trans('dash.ad.desc')]) !!}
        </div>
    </div>
{{-- </fieldset> --}}
<legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
<div class="text-right">
    <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
</div>
