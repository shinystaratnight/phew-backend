@extends('dashboard.layout')
@section('file_scripts')
    <script src="{{ asset('assets/global') }}/js/plugins/visualization/echarts/echarts.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>

    <script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/ui/moment/moment.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/pickers/daterangepicker.js"></script>

    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@section('custom_scripts')
    <script src="{{ asset('assets/global') }}/js/demo_pages/dashboard.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_extension_buttons_init.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery.js"></script>
    @include('dashboard.clients.custom_charts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            PostsChart.init();
        });
    </script>
@endsection
@section('page_title')
{{ trans('dash.client.client_data') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.client.index') }}" class="breadcrumb-item">{{ trans('dash.client.clients') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.client.client_data') }}</span>
@endsection
@section('content')
    <div class="profile-cover">
        <div class="profile-cover-img" style="background-image: url({{ asset('assets/global') }}/images/cover.jpg)"></div>
        <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
            <div class="mr-md-3 mb-2 mb-md-0">
                <a href="{{ $client->profile_image }}" class="profile-thumb" data-popup="lightbox">
                    <img src="{{ $client->profile_image }}" class="bg-white border-white rounded-circle" width="48" height="48" alt="">
                </a>
            </div>
            <div class="media-body text-white">
                <h1 class="mb-0">{{ trans('dash.user_data.fullname') }} : {{ $client->fullname }}</h1>
                <span class="d-block">{{ trans('dash.city.city') }} : {{ $client->city ? $client->city->name : trans('dash.messages.not_entered') }}</span>
            </div>
            <div class="ml-md-3 mt-2 mt-md-0">
                <ul class="list-inline list-inline-condensed mb-0">
                    <li class="list-inline-item"><a href="{{ route('dashboard.client.edit', $client->id) }}" class="btn btn-primary border-transparent"><i class="icon-pencil7 mr-2"></i>{{ trans('dash.actions.edit') }}</a></li>
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
                        {{ trans('dash.client.client_data') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#posts" class="navbar-nav-link" data-toggle="tab">
                        <i class="icon-play mr-2"></i>
                        {{ trans('dash.post.posts') }}
                        <span class="badge badge-pill bg-primary position-static ml-auto ml-lg-2">{{ $client->posts->count() }}</span>
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
                            <h5 class="card-title">{{ trans('dash.client.client_data') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="#">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.fullname') }} :</label>
                                        <input type="text" value="{{ $client->fullname }}" class="form-control" placeholder="{{ trans('dash.user_data.fullname') }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.mobile') }} :</label>
                                        <input type="text" value="{{ $client->mobile }}" class="form-control" placeholder="{{ trans('dash.user_data.mobile') }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.email') }} :</label>
                                        <input type="text" value="{{ $client->email }}" class="form-control" placeholder="{{ trans('dash.user_data.email') }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.gender') }} :</label>
                                        <input type="text" value="{{ $client->gender == 'male' ? 'ذكر - male' : ($client->gender == 'female' ? 'أنثى - female' : 'لم يحدد - did not specify') }}" class="form-control" placeholder="{{ trans('dash.user_data.iban_number') }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.status') }} :</label>
                                        <input type="text" value="{{ $client->is_active == '1' ? trans('dash.user_data.active_account') : trans('dash.user_data.deactive_account') }}" class="form-control" placeholder="{{ trans('dash.user_data.status') }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.status') }} :</label>
                                        <input type="text" value="{{ $client->is_banned == '1' ? trans('dash.user_data.banned_account') : trans('dash.user_data.unbanned_account') }}" class="form-control" placeholder="{{ trans('dash.user_data.status') }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.table.created_at') }} :</label>
                                        <input type="text" value="{{ $client->created_at->diffforHumans() }}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">{{ trans('dash.user_data.ban_reason') }} :</label>
                                        <textarea class="form-control" placeholder="{{ trans('dash.user_data.ban_reason') }}" readonly>
                                            {{ $client->ban_reason }}
                                        </textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="posts">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('dash.post.posts') }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table datatable-button-init-basic">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>{{ trans('dash.post.post') }}</th>
                                        <th>{{ trans('dash.post.created_by') }}</th>
                                        <th>{{ trans('dash.post.comment.comments') }}</th>
                                        <th>{{ trans('dash.post.retweet.retweet') }}</th>
                                        <th>{{ trans('dash.post.like.likes') }}</th>
                                        <th>{{ trans('dash.table.created_at') }}</th>
                                        <th>{{ trans('dash.table.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client->posts()->latest()->get() as $post)
                                    <tr class="text-center" id="row_{{ $post->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($post->media->count())
                                                @php
                                                    $media = $post->media->first();
                                                @endphp
                                                @if ($media->media_type == 'image')
                                                    <a href="{{ $media->data }}" data-popup="lightbox">
                                                        <img src="{{ $media->data }}" style="width: 150px" alt="" class="img-preview rounded">
                                                    </a>
                                                @elseif($media->media_type == 'video')
                                                    <center>
                                                        <div style="width: 150px" class="card-img embed-responsive embed-responsive-16by9">
                                                            <video style="width: 100%; height:100px" controls>
                                                                <source src="{{ $media->data }}" type="video/mp4">
                                                                <source src="{{ $media->data }}" type="video/ogg">
                                                                Your browser does not support HTML video.
                                                            </video>
                                                        </div>
                                                    </center>
                                                @elseif($media->media_type == 'location')
                                                    @php
                                                        $location = json_decode($media->data);
                                                    @endphp
                                                    {{-- <iframe width="150" height="100" frameborder="0" style="border:0"
                                                        src="https://www.google.com/maps/embed/v1/search?key={{ settings('google_map_key') }}&location={{ $location->lat }},{{ $location->lng }}" allowfullscreen>
                                                    </iframe> --}}
                                                    <iframe width="150" height="100" src="https://maps.google.com/maps?q={{ $location->lat }},{{ $location->lng }}&z=15&output=embed" frameborder="0" style="border:0"></iframe>
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/uploads/default.png') }}" style="width: 150px" alt="" class="img-preview rounded">
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->user_id)
                                                <a href="{{ route('dashboard.client.show', $post->user_id) }}"
                                                    class="text-default font-weight-bold">{{ $post->user->fullname }}</a>
                                            @else
                                                <a href="{{ route('dashboard.client.show', $post->user_id) }}"
                                                    class="text-default font-weight-bold">{{ trans('dash.messages.not_entered') }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $post->comments->count() }}</td>
                                        <td>{{ $post->retweet->count() }}</td>
                                        <td>0</td>
                                        <td>{{ $post->created_at->diffforHumans() }}</td>
                                        <td>
                                            <div class="list-icons">
                                                <div class="list-icons-item dropdown">
                                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('dashboard.post.show', $post->id) }}" class="dropdown-item"><i
                                                                class="icon-eye"></i>{{ trans('dash.actions.show') }}</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a onclick="sweet_delete('{{ route('dashboard.post.destroy', $post->id) }}', {{ $post->id }} )"
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
                    </div>
                </div>
            </div>
            <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-lg-2 sidebar-expand-md">
                <div class="sidebar-content">
                    <div class="card border-left-3 border-left-primary rounded-left-0">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="card-title font-weight-semibold">{{ trans('dash.notifications.send_notification') }}</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.notification.send_single') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name='user_id' value="{{ $client->id }}" />
                                <textarea name="message" class="form-control mb-3" rows="3" cols="1" placeholder="{{ trans('dash.messages.enter_your_message') }}"></textarea>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn bg-blue btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b>{{ trans('dash.buttons.send') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{ trans('dash.post.posts') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="posts_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.parts.delete_alert')
@endsection