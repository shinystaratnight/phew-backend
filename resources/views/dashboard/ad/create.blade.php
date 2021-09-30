@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.ad.add_new_ad') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.ad.index') }}" class="breadcrumb-item">{{ trans('dash.ad.ads') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.ad.add_new_ad') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.ad.ad_data') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'dashboard.ad.store' , 'method' => "POST" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.ad.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
