@extends('dashboard.layout')
@section('page_title')
{{ trans('dash.error.403') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.error.403') }}</span>
@endsection
@section('content')

<!-- Container -->
<div class="flex-fill">

    <!-- Error title -->
    <div class="text-center mb-3 mt-20">
        <h1 class="error-title">{!! trans('dash.error.403') !!}</h1>
        <h5>{!! trans('dash.error.403_msg') !!}</h5>
    </div>
    <!-- /error title -->


</div>
<!-- /container -->

@endsection
