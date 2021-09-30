@extends('dashboard.layout')
@section('page_title')
{{ trans('dash.city.edit_city_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.city.index') }}" class="breadcrumb-item">{{ trans('dash.city.cities') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.city.edit_city_data') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.city.edit_city_data') }} : {{ $city['name_' . app()->getLocale()] }}</h5>
            </div>
            <div class="card-body">
                {!! Form::model($city, ['route' => ['dashboard.city.update', $city->id] , 'method' => "PUT" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.city.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
