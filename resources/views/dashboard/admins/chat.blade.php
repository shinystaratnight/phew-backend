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
    <script src="{{ asset('assets/global') }}/js/custom/active.js"></script>
@endsection
@section('page_title')
{{ trans('dash.admins.admins') }}
@endsection
@section('sidebar_title')
    <span class="breadcrumb-item active">{{ trans('dash.admins.admins') }}</span>
@endsection
@section('content')
<div class="d-flex align-items-start flex-column flex-md-row">    
    <div class="tab-content w-100 order-2 order-md-1">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Default layout</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="media-list media-chat media-chat-scrollable mb-3">
                    <li class="media content-divider justify-content-center text-muted mx-0">Monday, Feb 10</li>
                    <li class="media">
                        <div class="mr-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-chat-item">Below mounted advantageous spread yikes bat stubbornly crud a and a excepting</div>
                            <div class="font-size-sm text-muted mt-2">Mon, 9:54 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                    </li>
                    <li class="media media-chat-item-reverse">
                        <div class="media-body">
                            <div class="media-chat-item">Far squid and that hello fidgeted and when. As this oh darn but slapped casually husky sheared that cardinal hugely one and some unnecessary factiously hedgehog a feeling one rudely much but one owing sympathetic regardless more astonishing evasive tasteful much.</div>
                            <div class="font-size-sm text-muted mt-2">Mon, 10:24 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                        <div class="ml-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                    </li>
                    <li class="media">
                        <div class="mr-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-chat-item">Darn over sour then cynically less roadrunner up some cast buoyant. Macaw krill when and upon less contrary warthog jeez some koala less since therefore minimal.</div>
                            <div class="font-size-sm text-muted mt-2">Mon, 10:56 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                    </li>
                    <li class="media media-chat-item-reverse">
                        <div class="media-body">
                            <div class="media-chat-item">Some upset impious a and submissive when far crane the belched coquettishly. More the puerile dove wherever</div>
                            <div class="font-size-sm text-muted mt-2">Mon, 11:29 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                        <div class="ml-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                    </li>
                    <li class="media content-divider justify-content-center text-muted mx-0">Yesterday</li>
                    <li class="media">
                        <div class="mr-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-chat-item">Regardless equitably hello heron glum cassowary jocosely before reliably a jeepers wholehearted shuddered more that some where far by koala.</div>
                            <div class="font-size-sm text-muted mt-2">Tue, 6:40 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                    </li>
                    <li class="media">
                        <div class="mr-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-chat-item">Crud reran and while much withdrew ardent much crab hugely met dizzily that more jeez gent equivalent unsafely far one hesitant so therefore.</div>
                            <div class="font-size-sm text-muted mt-2">Tue, 10:28 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                    </li>
                    <li class="media media-chat-item-reverse">
                        <div class="media-body">
                            <div class="media-chat-item">Thus superb the tapir the wallaby blank frog execrably much since dalmatian by in hot. Uninspiringly arose mounted stared one curt safe</div>
                            <div class="font-size-sm text-muted mt-2">Tue, 8:12 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                        <div class="ml-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                    </li>
                    <li class="media content-divider justify-content-center text-muted mx-0">Today</li>
                    <li class="media">
                        <div class="mr-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>

                        <div class="media-body">
                            <div class="media-chat-item">Tolerantly some understood this stubbornly after snarlingly frog far added insect into snorted more auspiciously heedless drunkenly jeez foolhardy oh.</div>
                            <div class="font-size-sm text-muted mt-2">Wed, 4:20 pm <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                    </li>
                    <li class="media media-chat-item-reverse">
                        <div class="media-body">
                            <div class="media-chat-item">Satisfactorily strenuously while sleazily dear frustratingly insect menially some shook far sardonic badger telepathic much jeepers immature much hey.</div>
                            <div class="font-size-sm text-muted mt-2">2 hours ago <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                        <div class="ml-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                    </li>
                    <li class="media">
                        <div class="mr-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>

                        <div class="media-body">
                            <div class="media-chat-item">Grunted smirked and grew less but rewound much despite and impressive via alongside out and gosh easy manatee dear ineffective yikes.</div>
                            <div class="font-size-sm text-muted mt-2">13 minutes ago <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                        </div>
                    </li>
                    <li class="media media-chat-item-reverse">
                        <div class="media-body">
                            <div class="media-chat-item"><i class="icon-menu"></i></div>
                        </div>
                        <div class="ml-3">
                            <a href="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg">
                                <img src="{{ asset('assets/global') }}/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </a>
                        </div>
                    </li>
                </ul>
                <textarea name="enter-message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>
                <div class="d-flex align-items-center">
                    <div class="list-icons list-icons-extended">
                        <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send photo"><i class="icon-file-picture"></i></a>
                        <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send video"><i class="icon-file-video"></i></a>
                        <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title="Send file"><i class="icon-file-plus"></i></a>
                    </div>
                    <button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Send</button>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-lg-2 sidebar-expand-md">
        <div class="sidebar-content">
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="card-title font-weight-semibold">Latest connections</span>
                    <div class="header-elements">
                        <span class="badge bg-success badge-pill">+32</span>
                    </div>
                </div>
                <ul class="media-list media-list-linked my-2">
                    <li class="media font-weight-semibold border-0 py-2">Office staff</li>

                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title font-weight-semibold">James Alexander</div>
                                <span class="text-muted font-size-sm">UI/UX expert</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-success border-success"></span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title font-weight-semibold">Jeremy Victorino</div>
                                <span class="text-muted font-size-sm">Senior designer</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-danger border-danger"></span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title"><span class="font-weight-semibold">Jordana Mills</span></div>
                                <span class="text-muted">Sales consultant</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-grey-300 border-grey-300"></span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title"><span class="font-weight-semibold">William Miles</span></div>
                                <span class="text-muted">SEO expert</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-success border-success"></span>
                            </div>
                        </a>
                    </li>

                    <li class="media font-weight-semibold border-0 py-2">Partners</li>

                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title font-weight-semibold">Margo Baker</div>
                                <span class="text-muted font-size-sm">Google</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-success border-success"></span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title font-weight-semibold">Beatrix Diaz</div>
                                <span class="text-muted font-size-sm">Facebook</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-warning-400 border-warning-400"></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="media">
                            <div class="mr-3">
                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-title font-weight-semibold">Richard Vango</div>
                                <span class="text-muted font-size-sm">Microsoft</span>
                            </div>
                            <div class="align-self-center ml-3">
                                <span class="badge badge-mark bg-grey-300 border-grey-300"></span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection