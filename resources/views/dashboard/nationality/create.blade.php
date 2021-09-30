@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.nationality.add_new_nationality') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.nationality.index') }}" class="breadcrumb-item">{{ trans('dash.nationality.nationalities') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.nationality.add_new_nationality') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.nationality.nationality_data') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'dashboard.nationality.store' , 'method' => "POST" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.nationality.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
