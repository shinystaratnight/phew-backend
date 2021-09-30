@extends('dashboard.layout')
@section('page_title')
{{ trans('dash.city.add_new_city') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.city.index') }}" class="breadcrumb-item">{{ trans('dash.city.cities') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.city.add_new_city') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.city.city_data') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'dashboard.city.store' , 'method' => "POST" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.city.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
