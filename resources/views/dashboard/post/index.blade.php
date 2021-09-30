@extends('dashboard.layout')
    @section('file_scripts')
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/global') }}/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets/global') }}/owlcarousel/dist/assets/owl.theme.default.min.css">
@endsection
@section('custom_scripts')
<script src="{{ asset('assets/global') }}/js/demo_pages/datatables_extension_buttons_init.js"></script>
<script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
<script src="{{ asset('assets/global') }}/owlcarousel/dist/owl.carousel.js"></script>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            items:2,
            merge:true,
            loop:false,
            center: true,
            margin:10,
            video:true,
            lazyLoad:true,
            center:true,
            responsive:{
                480:{
                    items:2
                },
                600:{
                    items:4
                }
            }
        });
    });
</script>
@endsection
@section('page_title')
    {{ trans('dash.post.posts') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.post.posts') }}</span>
@endsection
@section('content')
    <div class="timeline timeline-left">
        <div class="timeline-container">
            @foreach ($posts as $post)
                <div class="timeline-row" id="row_{{ $post->id }}">
                    <a href="{{ route('dashboard.client.show', $post->user_id) }}">
                        <div class="timeline-icon">
                            <img src="{{ $post->user->profile_image }}" alt="">
                        </div>
                    </a>
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <a href="{{ route('dashboard.client.show', $post->user_id) }}">
                                <h6 class="card-title">{{ $post->user->fullname }}</h6>
                            </a>
                            <div class="header-elements">
                                <span><i class="icon-watch2 mr-2 text-success"></i>{{ $post->created_at->diffforHumans() }}</span>
                                <div class="list-icons ml-3">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-arrow-down12"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('dashboard.post.show', $post->id) }}" class="dropdown-item">
                                                <i class="icon-eye"></i>
                                                {{ trans('dash.actions.show') }}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a onclick="sweet_delete('{{ route('dashboard.post.destroy', $post->id) }}', {{ $post->id }})" class="dropdown-item"><i class="icon-bin"></i>{{ trans('dash.actions.delete') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($post->media->count())
                                <div class="owl-carousel owl-theme" style="direction: ltr">
                                    @foreach ($post->media as $media)
                                        @if ($media->media_type == 'image')
                                            <div class="item-image" data-merge="{{ $loop->iteration }}">
                                                <img src="{{ $media->data }}" alt="" style="width: 100%; height: 400px">
                                            </div>
                                        @elseif ($media->media_type == 'video')
                                            <div class="item-video" data-merge="{{ $loop->iteration }}">
                                                <div style="width: 100%; height: 400px" class="card-img embed-responsive embed-responsive-16by9">
                                                    <video width="100%" controls>
                                                        <source src="{{ $media->data }}" type="video/mp4">
                                                        <source src="{{ $media->data }}" type="video/ogg">
                                                        Your browser does not support HTML video.
                                                    </video>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if ($post->text) 
                                <h6 class="mb-3"></h6>
                                <blockquote class="blockquote blockquote-bordered py-2 pl-3 mb-0">
                                    <p class="mb-2 font-size-base">{{ $post->text }}</p>
                                </blockquote>
                            @elseif($post->activity_type == 'location')
                                <h6 class="mb-3">{{ trans('dash.post.activity_types.location_post') }}</h6>
                                <blockquote class="blockquote blockquote-bordered py-2 pl-3 mb-0">
                                    <p class="mb-2 font-size-base">
                                        @php $media_type = $post->media()->where('media_type', 'location')->first(); @endphp
                                        @if($media_type)
                                            {{ json_decode($media_type->data, TRUE)['address'] }}
                                        @endif
                                    </p>
                                </blockquote>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent d-sm-flex justify-content-sm-between align-items-sm-center border-top-0 pt-0 pb-3">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="#" class="text-default"><i class="icon-heart6 mr-2"></i> {{ $post->likes->count() }}</a></li>
                                <li class="list-inline-item"><a href="#" class="text-default"><i class="icon-comment-discussion mr-2"></i>{{ $post->comments->count() }}</a></li>
                                <li class="list-inline-item"><a href="#" class="text-default"><i class="icon-star-empty3 mr-2"></i> {{ $post->favs->count() }}</a></li>
                                <li class="list-inline-item"><a href="#" class="text-default"><i class="icon-loop mr-2"></i> {{ $post->retweet->count() }}</a></li>
                                <li class="list-inline-item"><a href="#" class="text-default"><i class="icon-images2 mr-2"></i> {{ $post->users_screen_shot->count() }}</a></li>
                            </ul>
                            <a href="{{ route('dashboard.post.show', $post->id) }}" class="d-inline-block text-default mt-2 mt-sm-0 btn btn-primary text-white">{{ trans('dash.actions.show') }}<i class="icon-eye4 ml-2"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function sweet_delete(url, id)
        {
            swal({
                title: "{{ trans('dash.messages.deleted_msg_confirm') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {_method: 'delete', _token : '{{ csrf_token() }}' },
                        success: function (data) {
                            if(data['status'] == 'true'){
                                swal({
                                    title: "{{ trans('dash.messages.deleted_successfully_title') }}",
                                    text: data['message'],
                                    icon: "success",
                                });
                                $( "#row_" + id ).hide(1000);
                            }else{
                                swal({
                                    title: "{{ trans('dash.messages.sorry') }}",
                                    text: data['message'],
                                    icon: "warning",
                                });
                            }
                        }
                    });                               
                }
            });
        }
    </script>
@endsection