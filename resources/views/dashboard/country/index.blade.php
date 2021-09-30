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
{{ trans('dash.country.countries') }}
@endsection
@section('sidebar_title')
<span class="breadcrumb-item active">{{ trans('dash.country.countries') }}</span>
@endsection
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.country.countries') }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{ route('dashboard.country.create') }}"
                    class="btn btn-success btn-labeled btn-labeled-left"><b><i
                            class="icon-plus2"></i></b>{{ trans('dash.country.add_new_country') }}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $countries->links() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.country.flag') }}</th>
                    <th>{{ trans('dash.country.continent') }}</th>
                    <th>{{ trans('dash.country.name') }}</th>
                    <th>{{ trans('dash.country.in_findly') }}</th>
                    <th>{{ trans('dash.country.currency') }}</th>
                    <th>{{ trans('dash.country.short_name') }}</th>
                    <th>{{ trans('dash.country.phonecode') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr class="text-center" id="row_{{ $country->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ $country->flag_url }}" data-popup="lightbox">
                            <img src="{{ $country->flag_url }}" alt="" width="80" height="70" class="img-preview rounded">
                        </a>
                    </td>
                    <td>
                        @if ($country->continent == 'asia')
                            <span class="badge badge-primary">{{ trans('dash.country.continents.asia') }}</span>
                        @elseif($country->continent == 'africa')
                            <span class="badge badge-success">{{ trans('dash.country.continents.africa') }}</span>
                        @elseif($country->continent == 'europe')
                            <span class="badge badge-warning">{{ trans('dash.country.continents.europe') }}</span>
                        @elseif($country->continent == 'australia')
                            <span class="badge badge-danger">{{ trans('dash.country.continents.australia') }}</span>
                        @elseif($country->continent == 'south_america')
                            <span class="badge badge-info">{{ trans('dash.country.continents.south_america') }}</span>
                        @elseif($country->continent == 'north_america')
                            <span class="badge badge-secondary">{{ trans('dash.country.continents.north_america') }}</span>
                        @else
                            {{ trans('dash.messages.empty') }}
                        @endif
                    </td>
                    <td>{{ $country->name }}</td>
                    <td>
                        @if($country->in_findly == true)
                            <span class="badge badge-success">{{ trans('dash.country.confirmed') }}</span>
                        @else
                            <span class="badge badge-danger">{{ trans('dash.country.not_confirmed') }}</span>
                        @endif
                    </td>
                    <td>{{ $country->currency }}</td>
                    <td>{{ $country->short_name }}</td>
                    <td>{{ $country->phonecode }}</td>
                    <td>{{ $country->created_at->diffforHumans() }}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('dashboard.country.edit', $country->id) }}"
                                        class="dropdown-item"><i
                                            class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                    <a href="{{ route('dashboard.country.show', $country->id) }}"
                                        class="dropdown-item"><i
                                            class="icon-eye"></i>{{ trans('dash.actions.show') }}</a>

                                    <div class="dropdown-divider"></div>
                                    <a onclick="sweet_delete('{{ route('dashboard.country.destroy', $country->id) }}', {{ $country->id }})"
                                        class="dropdown-item"><i
                                            class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $countries->links() !!}
        </div>
    </div>
</div>
<!-- /basic initialization -->
@include('dashboard.parts.delete_alert')
@endsection