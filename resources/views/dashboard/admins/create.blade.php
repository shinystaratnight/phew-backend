@extends('dashboard.layout')

@section('page_title')
{{ trans('dash.admins.add_new_admin') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.admin.index') }}" class="breadcrumb-item">{{ trans('dash.admins.admins') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.admins.add_new_admin') }}</span>
@endsection
@section('content')
<!-- Vertical form options -->
<div class="row">
    <div class="col-md-6">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.admins.admin_data') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.admin.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('dashboard.admins.form')
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <a href="{{ route('dashboard.admin.index') }}" class="btn btn-primary text-white"><i class="icon-list2 mr-2"></i>{{ trans('dash.buttons.back_to_list') }}</a>
                        <button type="reset" class="btn btn-light"><i class="icon-reset mr-2"></i>{{ trans('dash.buttons.reset_data') }}</button>
                        <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.submit_back_to_list') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.admins.latest_admins') }}</h5>                
            </div>
            <table class="table datatable-basic">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ trans('dash.user_data.profile_image') }}</th>
                        <th>{{ trans('dash.user_data.fullname') }}</th>
                        <th>{{ trans('dash.user_data.mobile') }}</th>
                        <th>{{ trans('dash.table.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($last_admins as $admin)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ $admin->profile_image }}" data-popup="lightbox">
                                    <img src="{{ $admin->profile_image }}" alt="" class="img-preview rounded">
                                </a>
                            </td>
                            <td><a class="text-default font-weight-semibold">{{ $admin->fullname }}</a></td>
                            <td><a href="tel:{{ $admin->mobile }}">{{ $admin->mobile }}</a></td>
                            <td>{{ $admin->created_at->diffforHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /vertical form options -->    
@endsection