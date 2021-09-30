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
    {{ trans('dash.ad.ads') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.ad.ads') }}</span>
@endsection
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.ad.ads') }}</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a href="{{ route('dashboard.ad.create') }}"
                       class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                class="icon-plus2"></i></b>{{ trans('dash.ad.add_new_ad') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                {!! $ads->links() !!}
            </div>
            <table class="table datatable-button-init-basic">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.ad.ad') }}</th>
                    <th>{{ trans('dash.sponsor.sponsor') }}</th>
                    <th>{{ trans('dash.ad.start_date') }}</th>
                    <th>{{ trans('dash.ad.end_date') }}</th>
                    <th>{{ trans('dash.ad.visit_ad') }}</th>
                    <th>{{ trans('dash.ad.desc') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ads as $ad)
                    <tr class="text-center" id="row_{{ $ad->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($ad->image->option == 'image')
                                <a href="{{ $ad->file_url }}" data-popup="lightbox">
                                    <img src="{{ $ad->file_url }}" alt="" class="img-preview rounded">
                                </a>
                            @elseif($ad->image->option == 'video')
                                <div style="width: 150px" class="card-img embed-responsive embed-responsive-16by9">
                                    <video style="width: 100%; height:100px" controls>
                                        <source src="{{ $ad->file_url }}" type="video/mp4">
                                        <source src="{{ $ad->file_url }}" type="video/ogg">
                                        Your browser does not support HTML video.
                                    </video>
                                </div>
                        @endif
                        <td>{{ $ad->sponsor->name }}</td>
                        <td>
                            {{ $ad->start_date }}
                        </td>
                        <td>
                            {{ $ad->end_date }}
                        </td>
                        <td>
                            <a href="{{ $ad->url  }}" target="_blank">{{ trans('dash.ad.visit_ad') }}</a>
                        </td>
                        <td>
                            <span class="badge bg-success badge-pill">{{ str_limit($ad->desc, 50) }}</span>
                        </td>
                        <td>{{ $ad->created_at->diffforHumans() }}</td>
                        <td>
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('dashboard.ad.edit', $ad->id) }}"
                                           class="dropdown-item"><i
                                                class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <a onclick="sweet_delete('{{ route('dashboard.ad.destroy', $ad->id) }}', {{ $ad->id }})"
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
                {!! $ads->links() !!}
            </div>
        </div>
    </div>
    @include('dashboard.parts.delete_alert')
@endsection
