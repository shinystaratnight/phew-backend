@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.country.add_new_country') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.country.index') }}" class="breadcrumb-item">{{ trans('dash.country.countries') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.country.add_new_country') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.country.country_data') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'dashboard.country.store', 'method' => "POST" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.country.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
