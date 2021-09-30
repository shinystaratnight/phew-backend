@extends('dashboard.layout')
@section('page_title')
    {{ trans('dash.client.edit_client_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.client.index') }}" class="breadcrumb-item">{{ trans('dash.client.clients') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.client.edit_client_data') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.client.edit_client_data') }} : {{ $client->username }}</h5>
            </div>
            <div class="card-body">
                {!! Form::model($client, ['route' => ['dashboard.client.update', $client->id], 'method' => "PUT", 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.clients.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
