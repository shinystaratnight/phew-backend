@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.nationality.edit_nationality_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.nationality.index') }}" class="breadcrumb-item">{{ trans('dash.nationality.nationalities') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.nationality.edit_nationality_data') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.nationality.edit_nationality_data') }} : {{ $nationality->name }}</h5>
            </div>
            <div class="card-body">
                {!! Form::model($nationality, ['route' => ['dashboard.nationality.update', $nationality->id] , 'method' => "PUT" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.nationality.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
