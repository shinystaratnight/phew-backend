@extends('dashboard.layout')
@section('file_scripts')
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/datatables_extension_buttons_init.js"></script>
	<script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
    <script src="{{ asset('assets/global') }}/js/custom/active.js"></script>
@endsection
@section('page_title')
{{ trans('dash.admins.admins') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.admins.admins') }}</span>
@endsection
@section('content')
    <!-- Basic initialization -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.admins.admins') }}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a href="{{ route('dashboard.admin.create') }}" class="btn btn-success btn-labeled btn-labeled-left"><b><i class="icon-plus2"></i></b>{{ trans('dash.admins.add_new_admin') }}</a>
                </div>
            </div>
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.user_data.profile_image') }}</th>
                    <th>{{ trans('dash.permissions.permission') }}</th>
                    <th>{{ trans('dash.user_data.fullname') }}</th>
                    <th>{{ trans('dash.user_data.email') }}</th>
                    <th>{{ trans('dash.user_data.mobile') }}</th>
                    <th>{{ trans('dash.user_data.status') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr class="text-center" id="row_{{ $admin->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $admin->profile_image }}" data-popup="lightbox">
                                <img src="{{ $admin->profile_image }}" alt="" class="img-preview rounded">
                            </a>
                        </td>
                        <td><span class="badge badge-primary">{{ $admin->role->name }}</span></td>
                        <td><a class="text-default font-weight-semibold">{{ $admin->fullname }}</a></td>
                        <td><a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a></td>
                        <td><a href="tel:{{ $admin->mobile }}">{{ $admin->mobile }}</a></td>
                        <td>
                            @if($admin->is_banned == true)
                                <span class="badge badge-warning">{{ trans('dash.user_data.banned_account') }}</span>
                            @elseif($admin->is_active == false)
                                <span class="badge badge-danger">{{ trans('dash.user_data.deactive_account') }}</span>
                            {{--  @elseif(!$admin->email_verified_at)
                                 <a onclick='activeAdmin({{ $admin->id }}, "{{ route('dashboard.admin.update',$admin->id) }}","{{ trans('dash.user_data.active_account') }}")' class="admin-active{{ $admin->id }} btn btn-info" >@lang('dash.buttons.send')</a>  --}}
                            @else
                                <span class="badge badge-success">{{ trans('dash.user_data.active_account') }}</span>
                            @endif
                        </td>
                        <td>{{ $admin->created_at->diffforHumans() }}</td>
                        <td>
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('dashboard.admin.edit', $admin->id) }}" class="dropdown-item"><i class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                        {{--  <a href="#" class="dropdown-item"><i class="icon-copy4"></i>{{ trans('dash.actions.show') }}</a>  --}}
                                        {{--  <a href="{{ route('dashboard.admin.show', $admin->id) }}" class="dropdown-item"><i class="icon-eye"></i>{{ trans('dash.actions.show') }}</a>  --}}
                                        <div class="dropdown-divider"></div>
                                        <a onclick="sweet_delete( '{{ route('dashboard.admin.destroy', $admin->id) }}', {{ $admin->id }} )" class="dropdown-item"><i class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic initialization -->
    @include('dashboard.parts.delete_alert')
@endsection