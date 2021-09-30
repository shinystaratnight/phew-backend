@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.sponsor.add_new_sponsor') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.sponsor.index') }}" class="breadcrumb-item">{{ trans('dash.sponsor.sponsors') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.sponsor.add_new_sponsor') }}</span>
@endsection
@section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.sponsor.sponsor_data') }}</h5>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'dashboard.sponsor.store', 'method' => "POST" , 'files' => true , 'data-fouc']) !!}
                    @include('dashboard.sponsor.form')
				{!! Form::close() !!}
            </div>
        </div>
@endsection
