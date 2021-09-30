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
    <a href="{{ route('dashboard.post.index') }}" class="breadcrumb-item">{{ trans('dash.post.posts') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.post.post_number', ['post_number' => $post->id]) }}</span>
@endsection
@section('content')
    <div class="d-flex align-items-start flex-column flex-md-row">
        <div class="w-100 overflow-auto order-2 order-md-1">
            <!-- Post -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="mb-3 text-center">
                            @if ($post->media->count())
                                @if ($post->media->whereIn('media_type', ['location', 'watching'])->first())
                                    @php
                                        $media = $post->media->whereIn('media_type', ['location', 'watching'])->first();
                                    @endphp
                                    @if($media->media_type == 'location')
                                        @php
                                            $location = json_decode($media->data);
                                        @endphp
                                        <iframe width="100%" height="400" src="https://maps.google.com/maps?q={{ $location->lat }},{{ $location->lng }}&z=15&output=embed" frameborder="0" style="border:0"></iframe>
                                    @else
                                        @php
                                            $movie = json_decode($media->data);
                                        @endphp
                                        @if(isset($movie->poster_path))
                                            <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" style="width: 50%; height: 300;" alt="" class="img-fluid rounded">
                                        @else
                                            <img src="{{ asset('storage/uploads/default.png') }}" style="width: 50%; height: 300;" alt="" class="img-fluid rounded">
                                        @endif
                                    @endif
                                @else
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
                            @endif
                        </div>

                        <ul class="list-inline list-inline-dotted text-muted mb-3">
                            <li class="list-inline-item">{{ trans('dash.post.created_by') }} : <a href="{{ route('dashboard.client.show', $post->user_id) }}" class="text-muted">{{ $post->user->fullname }}</a></li>
                            <li class="list-inline-item">{{ $post->created_at->diffforHumans() }}</li>
                            <li class="list-inline-item"><a class="text-muted"><i class="icon-comment-discussion mr-2"></i> {{ $post->comments->count() }} {{ trans('dash.post.comment.comments') }}</a></li>
                            <li class="list-inline-item"><a class="text-muted" data-toggle="modal" data-target="#modal_like"><i class="icon-heart6 font-size-base text-pink mr-2"></i> {{ $post->likes->count() }} {{ trans('dash.post.like.likes') }}</a></li>
                            <li class="list-inline-item"><a class="text-muted" data-toggle="modal" data-target="#modal_fav"><i class="icon-star-empty3 font-size-base text-pink mr-2"></i> {{ $post->favs->count() }} {{ trans('dash.post.fav.favs') }}</a></li>
                            <li class="list-inline-item"><a class="text-muted"><i class="icon-loop font-size-base text-pink mr-2"></i> {{ $post->retweet->count() }} {{ trans('dash.post.retweet.retweet') }}</a></li>
                            <li class="list-inline-item"><a class="text-muted" data-toggle="modal" data-target="#modal_screen"><i class="icon-images2 font-size-base text-pink mr-2"></i> {{ $post->users_screen_shot->count() }} {{ trans('dash.post.screen_shot.screen_shots') }}</a></li>
                        </ul>

                        <div class="card card-body bg-light rounded-left-0 border-left-3 border-left-warning">
                            <blockquote class="blockquote d-flex mb-0">
                                <div class="mr-3">
                                    
                                </div>
                                <div>
                                    <p class="mb-1">{{ $post->text }}</p>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /post -->
            
            <!-- About author -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">{{ trans('dash.post.author_data') }}</h6>

                    {{-- <div class="header-elements">
                        <div class="list-icons list-icons-extended">
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Google Drive"><i class="icon-google-drive"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Twitter"><i class="icon-twitter"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Github"><i class="icon-github"></i></a>
                            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Linked In"><i class="icon-linkedin"></i></a>
                        </div>
                    </div> --}}
                </div>

                <div class="media card-body flex-column flex-md-row m-0">
                    <div class="mr-md-3 mb-2 mb-md-0">
                        <a href="#">
                            <img src="{{ $post->user->profile_image }}" class="rounded-circle" width="64" height="64" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-title font-weight-semibold">{{ $post->user->fullname }}</h6>
                        <p class="media-title font-weight-semibold">{{ trans('dash.city.city') }} : {{ $post->user->city ? $post->user->city->name : trans('dash.messages.not_entered') }}</p>
                    </div>
                </div>
            </div>
            <!-- /about author -->

            <!-- Comments -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title font-weight-semibold">{{ trans('dash.post.comment.comments') }}</h6>
                    <div class="header-elements">
                        <ul class="list-inline list-inline-dotted text-muted mb-0">
                            <li class="list-inline-item">{{ $post->comments->count() }} {{ trans('dash.post.comment.comments') }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="media-list">
                        @forelse ($post->comments as $comment)
                            <li class="media flex-column flex-md-row">
                                <div class="mr-md-3 mb-2 mb-md-0">
                                    <a href="#"><img src="{{ $comment->user->profile_image }}" class="rounded-circle" width="38" height="38" alt=""></a>
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#" class="font-weight-semibold">{{ $comment->user->fullname }}</a>
                                        <span class="text-muted ml-3">{{ $comment->created_at->diffforHumans() }}</span>
                                    </div>

                                    <p>{{ $comment->text }}</p>

                                    <ul class="list-inline list-inline-dotted font-size-sm">
                                        <li class="list-inline-item"><i class="icon-comment-discussion mr-2"></i>{{ $comment->comments->count() }} </li>
                                        {{-- <li class="list-inline-item"><a href="#">Reply</a></li>
                                        <li class="list-inline-item"><a href="#">Edit</a></li> --}}
                                    </ul>

                                    @foreach ($comment->comments as $reply)
                                        <div class="media flex-column flex-md-row">
                                            <div class="mr-md-3 mb-2 mb-md-0">
                                                <a href="#"><img src="{{ $reply->user->profile_image }}" class="rounded-circle" width="38" height="38" alt=""></a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-title">
                                                    <a href="#" class="font-weight-semibold">{{ $reply->user->fullname }}</a>
                                                    <span class="text-muted ml-3">{{ $reply->created_at->diffforHumans() }}</span>
                                                </div>

                                                <p>
                                                    {{ $reply->text }}
                                                </p>

                                                <ul class="list-inline list-inline-dotted font-size-sm">
                                                    <li class="list-inline-item">67 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                                    <li class="list-inline-item"><a href="#">Reply</a></li>
                                                    <li class="list-inline-item"><a href="#">Edit</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        @empty
                            {{ trans('dash.messages.empty') }}
                        @endforelse
                    </ul>
                </div>
            </div>
            <!-- /comments -->

        </div>
    </div>

    
    <div id="modal_like" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('dash.post.like.likes') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <ul class="media-list">
                            @foreach($post->likes as $like)
                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#">
                                            <img src="{{ $like->user->profile_image }}" class="rounded-circle" width="40" height="40" alt="">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title font-weight-semibold">{{ $like->user->fullname ? $like->user->fullname : $like->user->username}}</div>
                                        <span class="text-muted">{{ optional($like->user->city)->name }}</span>
                                    </div>

                                    <div class="align-self-center ml-3">
                                        {{ $like->created_at->diffforHumans() }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_fav" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('dash.post.fav.favs') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <ul class="media-list">
                            @foreach($post->favs as $fav)
                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#">
                                            <img src="{{ $fav->user->profile_image }}" class="rounded-circle" width="40" height="40" alt="">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title font-weight-semibold">{{ $fav->user->fullname ? $fav->user->fullname : $fav->user->username}}</div>
                                        <span class="text-muted">{{ optional($fav->user->city)->name }}</span>
                                    </div>

                                    <div class="align-self-center ml-3">
                                        {{ $fav->created_at->diffforHumans() }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_screen" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('dash.post.screen_shot.screen_shots') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <ul class="media-list">
                            @foreach($post->screen_shots as $screen_shot)
                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#">
                                            <img src="{{ $screen_shot->user->profile_image }}" class="rounded-circle" width="40" height="40" alt="">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title font-weight-semibold">{{ $screen_shot->user->fullname ? $screen_shot->user->fullname : $screen_shot->user->username}}</div>
                                        <span class="text-muted">{{ optional($screen_shot->user->city)->name }}</span>
                                    </div>

                                    <div class="align-self-center ml-3">
                                        {{ $screen_shot->created_at->diffforHumans() }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
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