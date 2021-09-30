@extends('dashboard.layout')

@section('page_title')
    {{ trans('dash.client.add_new_client') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.client.index') }}" class="breadcrumb-item">{{ trans('dash.client.clients') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.client.add_new_client') }}</span>
@endsection
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.client.client_data') }}</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'dashboard.client.store', 'method' => 'POST', 'files' => true, 'data-fouc']) !!}
            @include('dashboard.clients.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
