@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.country.edit_country_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.country.index') }}" class="breadcrumb-item">{{ trans('dash.country.countries') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.country.edit_country_data') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.country.edit_country_data') }} : {{ $country->name }}</h5>
            </div>
            <div class="card-body">
                {!! Form::model($country, ['route' => ['dashboard.country.update', $country->id], 'method' => "PUT" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.country.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
