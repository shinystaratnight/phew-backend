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
{{ trans('dash.sponsor.sponsors') }}
@endsection
@section('sidebar_title')
<span class="breadcrumb-item active">{{ trans('dash.sponsor.sponsors') }}</span>
@endsection
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.sponsor.sponsors') }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{ route('dashboard.sponsor.create') }}"
                    class="btn btn-success btn-labeled btn-labeled-left"><b><i
                            class="icon-plus2"></i></b>{{ trans('dash.sponsor.add_new_sponsor') }}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            {!! $sponsors->links() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.sponsor.logo') }}</th>
                    <th>{{ trans('dash.sponsor.name') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sponsors as $sponsor)
                <tr class="text-center" id="row_{{ $sponsor->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ $sponsor->logo_url }}" data-popup="lightbox">
                            <img src="{{ $sponsor->logo_url }}" width="100px" alt="" class="img-preview rounded">
                        </a>
                    </td>
                    <td>{{ $sponsor->name }}</td>
                    <td>{{ $sponsor->created_at->diffforHumans() }}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('dashboard.sponsor.edit', $sponsor->id) }}"
                                        class="dropdown-item"><i
                                            class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                     <div class="dropdown-divider"></div>
                                    <a onclick="sweet_delete('{{ route('dashboard.sponsor.destroy', $sponsor->id) }}', {{ $sponsor->id }})"
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
            {!! $sponsors->links() !!}
        </div>
    </div>
</div>
@include('dashboard.parts.delete_alert')
@endsection