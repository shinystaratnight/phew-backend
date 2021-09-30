@extends('dashboard.layout')

@section('page_title')
    {{ trans('dash.package.edit_package_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.package.index') }}" class="breadcrumb-item">{{ trans('dash.package.packages') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.package.edit_package_data') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.package.edit_package_data') }} : {{ $package->name }}</h5>
            </div>
            <div class="card-body">
                {!! Form::model($package, ['route' => ['dashboard.package.update', $package->id], 'method' => "PUT" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.package.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
