@extends('dashboard.layout')
@section('page_title')
    {{ trans('dash.package.edit_price') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.package.index') }}" class="breadcrumb-item">{{ trans('dash.package.packages') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.package.edit_price') }}</span>
@endsection
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.package.edit_price') }}</h5>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => ['dashboard.package.update_price', $package->id], 'method' => "PUT", 'data-fouc']) !!}
        @foreach ($package->countries as $country)
            <div class="form-group row">
                <label class="col-form-label col-lg-3">{{ trans('dash.country.country') }} : <span class="badge badge-flat border-primary text-primary font-size-lg">{{ $country->name }}</span></label>
                <div class="col-lg-9">
                    {!! Form::text("country_list[$country->id][price]", optional($country->pivot)->price, ['class' => 'form-control' , 'placeholder' => trans('dash.package.edit_price')]) !!}
                </div>
            </div>
        @endforeach

        <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
        <div class="text-right">
            <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('file_scripts')
<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
@endsection

@section('custom_scripts')
<script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
@endsection
