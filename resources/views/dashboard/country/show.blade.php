@extends('dashboard.layout')

@section('style')
    <style>
        .scroll-y{
            height: 425px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .scroll-y::-webkit-scrollbar {
            width: 5px;
        }
        .scroll-y::-webkit-scrollbar-thumb {
            background-color: #2196f3;
        }
    </style>
@endsection
@section('file_scripts')
    <!-- Theme JS files -->
    <script src="{{ asset('assets/global') }}/js/plugins/visualization/echarts/echarts.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/ui/moment/moment.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/pickers/daterangepicker.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
    <!-- /theme JS files -->
@endsection

@section('custom_scripts')
    <script src="{{ asset('assets/global') }}/js/demo_pages/dashboard.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
    @include('dashboard.country.custom_charts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            UsersChart.init();
        });
    </script>
@endsection


@section('page_title')
{{ trans('dash.country.country_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.country.index') }}" class="breadcrumb-item">{{ trans('dash.country.countries') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.country.show_country') }}</span>
@endsection
@section('content')
    <div class="profile-cover">
        <div class="profile-cover-img" style="background-image: url({{ asset('assets/global') }}/images/cover.jpg)"></div>
        <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
            <div class="mr-md-3 mb-2 mb-md-0">
                <a href="{{ $country->flag_url }}" class="profile-thumb" data-popup="lightbox">
                    <img src="{{ $country->flag_url }}" class="bg-white border-white rounded-circle" width="48" height="48" alt="">
                </a>
            </div>
            <div class="media-body text-white">
                <h1 class="mb-0">{{ $country->name }}</h1>
            </div>
            <div class="ml-md-3 mt-2 mt-md-0">
                <ul class="list-inline list-inline-condensed mb-0">
                    <li class="list-inline-item"><a href="{{ route('dashboard.country.edit', $country->id) }}" class="btn btn-primary border-transparent"><i class="icon-pencil7 mr-2"></i>{{ trans('dash.actions.edit') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-second">
                <i class="icon-menu7 mr-2"></i>
                Profile navigation
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-second">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="#data" class="navbar-nav-link active" data-toggle="tab">
                        <i class="icon-menu7 mr-2"></i>
                        {{ trans('dash.country.show_country') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#my_cities" class="navbar-nav-link " data-toggle="tab">
                        <i class="icon-menu7 mr-2"></i>
                        {{ trans('dash.city.cities') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="#statistics" class="navbar-nav-link" data-toggle="tab">
                        <i class="icon-stats-dots mr-2"></i>
                        {{ trans('dash.country.statistics') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="d-flex align-items-start flex-column flex-md-row">
            <div class="tab-content w-100 order-2 order-md-1">
                <div class="tab-pane fade active show" id="data">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('dash.country.show_country') }}</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('dash.country.name') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $country->name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('dash.country.short_name') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $country->short_name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('dash.country.currency') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $country->currency  }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('dash.country.show_phonecode') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $country->show_phonecode }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('dash.country.continent') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $country->continent  }}" readonly>

                                    </div>
                                </div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <a href="{{ route('dashboard.country.index') }}"
                                        class="btn btn-primary text-white"><i class="icon-list2 mr-2"></i>{{ trans('dash.buttons.back_to_list') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="my_cities">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('dash.city.cities') }}</h5>
                        </div>
                        <table class="table datatable-button-init-basic">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{ trans('dash.city.name') }}</th>
                                <th>{{ trans('dash.table.created_at') }}</th>
                                <th>{{ trans('dash.table.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($country->cities as $city)
                                <tr class="text-center" id="row_{{ $city->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->created_at->diffforHumans() }}</td>
                                    <td>
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown">
                                                <a href="#"
                                                   class="list-icons-item caret-0 dropdown-toggle"
                                                   data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    {{-- <a href="{{ route('dashboard.city.edit', $city->id) }}"
                                                       class="dropdown-item"><i
                                                                class="icon-pencil7"></i>{{ trans('dash.actions.edit') }}
                                                    </a> --}}
                                                    <a href="{{ route('dashboard.city.show', $city->id) }}"
                                                       class="dropdown-item"><i
                                                                class="icon-eye"></i>{{ trans('dash.actions.show') }}
                                                    </a>

                                                    {{-- <div class="dropdown-divider"></div>
                                                    <a onclick="sweet_delete('{{ route('dashboard.city.destroy', $city->id) }}', {{ $city->id }})"
                                                       class="dropdown-item"><i class="icon-bin"></i>{{ trans('dash.actions.delete') }}
                                                    </a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="statistics">
                     <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">  {{ trans('dash.country.statistics') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="{{ route('dashboard.city.index') }}">
                                        <div class="card bg-{{ random_colors() }}">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h3 class="font-weight-semibold mb-0">{{ $cities_count }}</h3>
                                                </div>
                                                <div>
                                                    {{ trans('dash.city.count') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <a href="{{ route('dashboard.client.index') }}">
                                        <div class="card bg-{{ random_colors() }}">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h3 class="font-weight-semibold mb-0">{{ $clients_count }}</h3>
                                                </div>
                                                <div>
                                                    {{ trans('dash.home.clients_count') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="customers_chart" style="height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection