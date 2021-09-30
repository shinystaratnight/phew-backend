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
@endsection
@section('page_title')
{{ trans('dash.package.packages') }}
@endsection
@section('sidebar_title')
<span class="breadcrumb-item active">{{ trans('dash.package.packages') }}</span>
@endsection
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.package.packages') }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{ route('dashboard.package.create') }}"
                    class="btn btn-success btn-labeled btn-labeled-left"><b><i
                            class="icon-plus2"></i></b>{{ trans('dash.package.add_new_package') }}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $packages->links() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.package.name') }}</th>
                    <th>{{ trans('dash.package.price') }}</th>
                    <th>{{ trans('dash.package.package_type') }}</th>
                    <th>{{ trans('dash.package.period') }}</th>
                    <th>{{ trans('dash.package.period_type') }}</th>
                    <th>{{ trans('dash.package.plan') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr class="text-center" id="row_{{ $package->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->name }}</td>
                    <td>
                        {{ $package->package_type == 'free' ? trans('dash.package.free_package') : $package->price }}
                    </td>
                    <td>{{ $package->package_type == 'free' ? trans('dash.package.free_package') : trans('dash.package.paid_package') }}
                    </td>
                    <td>{{ $package->package_type == 'free' ? trans('dash.package.duration_is_not_specified') : $package->period }}
                    </td>
                    <td>
                        @if ($package->package_type == 'free')
                        <span class="badge badge-warning">{{ trans('dash.package.duration_is_not_specified') }}</span>
                        @else
                            @if($package->period_type == 'hours')
                                <span class="badge badge-primary">{{ trans('dash.package.period_types.hours') }}</span>
                            @elseif($package->period_type == 'days')
                                <span class="badge badge-secondary">{{ trans('dash.package.period_types.days') }}</span>
                            @elseif($package->period_type == 'weeks')
                                <span class="badge badge-warning">{{ trans('dash.package.period_types.weeks') }}</span>
                            @elseif($package->period_type == 'months')
                                <span class="badge badge-info">{{ trans('dash.package.period_types.months') }}</span>
                            @else
                                <span class="badge badge-success">{{ trans('dash.package.period_types.years') }}</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @foreach ($package->plan as $key => $value)
                            <span class="badge bg-success badge-pill">{{ trans('dash.package.plans.' . $key) }} : {{ $value }}</span>
                        @endforeach
                    </td>
                    <td>{{ $package->created_at->diffforHumans() }}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('dashboard.package.edit', $package->id) }}"
                                        class="dropdown-item"><i
                                            class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                    {{--  <div class="dropdown-divider"></div>
                                    <a onclick="sweet_delete('{{ route('dashboard.package.destroy', $package->id) }}', {{ $package->id }})"
                                        class="dropdown-item"><i
                                            class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>  --}}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $packages->links() !!}
        </div>
    </div>
</div>
@include('dashboard.parts.delete_alert')
@endsection