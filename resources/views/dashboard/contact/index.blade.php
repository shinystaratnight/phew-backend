@extends('dashboard.layout')
@section('file_scripts')
<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@section('custom_scripts')
<script src="{{ asset('assets/global') }}/js/demo_pages/datatables_extension_buttons_init.js"></script>
@endsection
@section('page_title')
{{ trans('dash.contacts.contacts') }}
@endsection
@section('sidebar_title')
<span class="breadcrumb-item active">{{ trans('dash.contacts.contacts') }}</span>
@endsection
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.contacts.contacts') }}</h5>
    </div>
    <table class="table datatable-button-init-basic">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>{{ trans('dash.contacts.name') }}</th>
                <th>{{ trans('dash.contacts.mobile') }}</th>
                <th>{{ trans('dash.contacts.content') }}</th>
                <th>{{ trans('dash.contacts.is_seen') }}</th>
                <th>{{ trans('dash.table.created_at') }}</th>
                <th>{{ trans('dash.table.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr class="text-center" id="row_{{ $contact->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($contact->user_id)
                        <a href="{{ route('dashboard.client.show', $contact->user_id) }}" class="text-default font-weight-semibold">{{ $contact->user->username }}</a></td>
                    @elseif($contact->username)
                        {{ $contact->username }}
                    @else
                        {{ trans('dash.messages.not_entered') }}
                    @endif
                <td>
                    @if($contact->user_id)
                        <a href="tel:{{ $contact->user->mobile }}" class="text-default font-weight-semibold">{{ $contact->user->mobile }}</a></td>
                    @elseif($contact->mobile)
                        <a href="tel:{{ $contact->mobile }}" class="text-default font-weight-semibold">{{ $contact->mobile }}</a></td>
                    @else
                        {{ trans('dash.messages.not_entered') }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.contact.show', $contact->id) }}" data-popup="tooltip"
                        title="{{ $contact->content }}">
                        {{ substr($contact->content, 0, 100) }} ...
                    </a>
                </td>
                <td>
                    @if($contact->read_at == null)
                        <span class="badge badge-warning">{{ trans('dash.contacts.unseen') }}</span>
                    @else
                        <span class="badge badge-primary">{{ trans('dash.contacts.seen') }}</span>
                    @endif
                </td>
                <td>{{ $contact->created_at->diffforHumans() }}</td>
                <td>
                    <div class="list-icons">
                        <div class="list-icons-item dropdown">
                            <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('dashboard.contact.show', $contact->id) }}" class="dropdown-item"><i
                                        class="icon-eye"></i>{{ trans('dash.actions.show') }}</a>
                                <div class="dropdown-divider"></div>
                                <a onclick="sweet_delete( '{{ route('dashboard.contact.destroy', $contact->id) }}', {{ $contact->id }} )"
                                    class="dropdown-item"><i class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>
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