@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.package.add_new_package') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.package.index') }}" class="breadcrumb-item">{{ trans('dash.package.packages') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.package.add_new_package') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.package.package_data') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'dashboard.package.store' , 'method' => "POST" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.package.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
