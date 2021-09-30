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
{{ trans('dash.nationality.nationalities') }}
@endsection
@section('sidebar_title')
<span class="breadcrumb-item active">{{ trans('dash.nationality.nationalities') }}</span>
@endsection
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.nationality.nationalities') }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{ route('dashboard.nationality.create') }}"
                    class="btn btn-success btn-labeled btn-labeled-left"><b><i
                            class="icon-plus2"></i></b>{{ trans('dash.nationality.add_new_nationality') }}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $nationalities->links() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.nationality.name') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nationalities as $nationality)
                <tr class="text-center" id="row_{{ $nationality->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $nationality->name }}</td>
                    <td>{{ $nationality->created_at->diffforHumans() }}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('dashboard.nationality.edit', $nationality->id) }}"
                                        class="dropdown-item"><i
                                            class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                    {{-- <a href="{{ route('dashboard.nationality.show', $nationality->id) }}"
                                        class="dropdown-item"><i
                                            class="icon-eye"></i>{{ trans('dash.actions.show') }}</a> --}}

                                    <div class="dropdown-divider"></div>
                                    <a onclick="sweet_delete('{{ route('dashboard.nationality.destroy', $nationality->id) }}', {{ $nationality->id }})"
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
            {!! $nationalities->links() !!}
        </div>
    </div>
</div>
<!-- /basic initialization -->
@include('dashboard.parts.delete_alert')
@endsection