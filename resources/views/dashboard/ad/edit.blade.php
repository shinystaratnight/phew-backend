@extends('dashboard.layout')

@section('page_title')
    {{ trans('dash.ad.edit_ad_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.ad.index') }}" class="breadcrumb-item">{{ trans('dash.ad.ads') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.ad.edit_ad_data') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.ad.edit_ad_data') }} : {{ $ad->name }}</h5>
            </div>
            <div class="card-body">
                {!! Form::model($ad, ['route' => ['dashboard.ad.update', $ad->id] , 'method' => "PUT" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.ad.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
