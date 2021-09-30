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
    {{ trans('dash.client.clients') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.client.clients') }}</span>
@endsection
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.client.clients') }}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a href="{{ route('dashboard.client.create') }}" class="btn btn-success btn-labeled btn-labeled-left"><b><i class="icon-plus2"></i></b>{{ trans('dash.client.add_new_client') }}</a>
                    <a class="btn btn-primary btn-labeled btn-labeled-left text-white" data-toggle="modal" data-target="#myModal"><b><i class="icon-bell3"></i></b>{{ trans('dash.notifications.send_notification') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                {!! $clients->links() !!}
            </div>
            <table class="table datatable-button-init-basic">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ trans('dash.user_data.profile_image') }}</th>
                        <th>{{ trans('dash.user_data.username') }}</th>
                        <th>{{ trans('dash.user_data.fullname') }}</th>
                        <th>{{ trans('dash.user_data.email') }}</th>
                        <th>{{ trans('dash.user_data.mobile') }}</th>
                        <th>{{ trans('dash.user_data.status') }}</th>
                        <th>{{ trans('dash.table.created_at') }}</th>
                        <th>{{ trans('dash.table.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr class="text-center" id="row_{{ $client->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $client->profile_image }}" data-popup="lightbox">
                                <img src="{{ $client->profile_image }}" alt="" class="img-preview rounded">
                            </a>
                        </td>
                        <td>
                            @if($client->fullname)
                                <a href="{{ route('dashboard.client.show', $client->id) }}" class="text-default font-weight-bold">{{ $client->fullname }}</a>
                            @else
                                <a href="{{ route('dashboard.client.show', $client->id) }}" class="text-default font-weight-bold">{{ trans('dash.messages.not_entered') }}</a>
                            @endif
                        </td>
                        <td>
                            @if($client->username)
                                <a href="{{ route('dashboard.client.show', $client->id) }}" class="text-default font-weight-bold">{{ $client->username }}</a>
                            @else
                                <a href="{{ route('dashboard.client.show', $client->id) }}" class="text-default font-weight-bold">{{ trans('dash.messages.not_entered') }}</a>
                            @endif
                        </td>
                        <td>
                            @if($client->email)
                                <a href="mailto:{{ $client->email }}">{{ $client->email }}</a>
                            @else
                                {{ trans('dash.messages.not_entered') }}
                            @endif
                        </td>
                        <td>
                            @if($client->mobile)
                                <a href="tel:{{ $client->mobile }}">{{ $client->mobile }}</a>
                            @else
                                {{ trans('dash.messages.not_entered') }}
                            @endif
                        </td>
                        <td>
                            @if($client->is_banned == true)
                                <span class="badge badge-warning">{{ trans('dash.user_data.banned_account') }}</span>
                            @elseif($client->is_active == 0)
                                <span class="badge badge-danger">{{ trans('dash.user_data.deactive_account') }}</span>
                            @else
                                <span class="badge badge-success">{{ trans('dash.user_data.active_account') }}</span>
                            @endif
                        </td>
                        <td>{{ $client->created_at->diffforHumans() }}</td>
                        <td>
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('dashboard.client.edit', $client->id) }}" class="dropdown-item"><i class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                        {{-- <a href="#" class="dropdown-item"><i class="icon-copy4"></i>{{ trans('dash.actions.show') }}</a> --}}
                                        <a href="{{ route('dashboard.client.show', $client->id) }}" class="dropdown-item"><i class="icon-eye"></i>{{ trans('dash.actions.show') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <a onclick="sweet_delete('{{ route('dashboard.client.destroy', $client->id) }}', {{ $client->id }} )" class="dropdown-item"><i class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $clients->links() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('dash.notifications.send_notification') }}</h4>
                </div>
                <form action="{{ route('dashboard.notification.send_multiple') }}" method="POST">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="hidden" name='type' value="client" />
                        <div class="form-group">
                            <textarea name="message" class="form-control mb-15" rows="5" cols="1" placeholder="{{ trans('dash.messages.enter_your_message') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-bell3"></i></b>{{ trans('dash.buttons.send') }}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('dashboard.parts.delete_alert')
@endsection
