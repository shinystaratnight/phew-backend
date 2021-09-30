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
    <script src="{{ asset('assets') }}/global/js/demo_pages/form_select2.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_extension_buttons_init.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
@endsection
@section('page_title')
    {{ trans('dash.city.cities') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.city.cities') }}</span>
@endsection
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('dash.city.cities') }}</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{ route('dashboard.city.create') }}" class="btn btn-success btn-labeled btn-labeled-left"><b><i class="icon-plus2"></i></b>{{ trans('dash.city.add_new_city') }}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <hr>
        {!! Form::open(['route' => 'dashboard.city.index' , 'method' => 'GET']) !!}
        <div class="form-group row pt-3">
            <div class="col-md-11">
                {!! Form::select("country_id",$countries, null, ['class' => 'form-control select-search' , 'placeholder' => trans('dash.country.country')]) !!}
            </div>
            <div class="col-md-1 text-center">
                <button type="submit" class="btn btn-info btn-sm">{!! trans('dash.buttons.send') !!}</button>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="d-flex justify-content-center">
            {!! $cities->links() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.country.flag') }}</th>
                    <th>{{ trans('dash.country.name') }}</th>
                    <th>{{ trans('dash.city.name') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                    <th>{{ trans('dash.table.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                <tr class="text-center" id="row_{{ $city->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ $city->country->flag_url }}" data-popup="lightbox">
                            <img src="{{ $city->country->flag_url }}" alt="" width="80" height="70" class="img-preview rounded">
                        </a>
                    </td>
                    <td>{{ $city->country->name }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->created_at->diffforHumans() }}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('dashboard.city.edit', $city->id) }}" class="dropdown-item"><i class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}</a>
                                    {{--  <a href="{{ route('dashboard.city.show', $city->id) }}" class="dropdown-item"><i class="icon-eye"></i>{{ trans('dash.actions.show') }}</a>  --}}
                                    <div class="dropdown-divider"></div>
                                    <a onclick="sweet_delete('{{ route('dashboard.city.destroy', $city->id) }}', {{ $city->id }} )" class="dropdown-item"><i class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $cities->links() !!}
        </div>
    </div>
</div>
<!-- /basic initialization -->
@include('dashboard.parts.delete_alert')
@endsection
