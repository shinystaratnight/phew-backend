@extends('dashboard.layout')
@section('file_scripts')
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
@endsection

@section('custom_scripts')
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/gallery.js"></script>
@endsection
@section('page_title')
{{ trans('dash.contacts.show_contact_message') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.contact.index') }}" class="breadcrumb-item">{{ trans('dash.contacts.contacts') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.contacts.show_contact_message') }}</span>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.contacts.show_contact_message') }}</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.contacts.name') }} :</label>
                        <div class="col-lg-9">
                            @if($contact->user_id)
                                <input type="text" class="form-control" value="{{ $contact->User->username }}" readonly>
                            @elseif($contact->username)
                                <input type="text" class="form-control" value="{{ $contact->username }}" readonly>
                            @else
                                <input type="text" class="form-control" value="{{ trans('dash.messages.not_entered') }}" readonly>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.contacts.email') }} :</label>
                        <div class="col-lg-9">
                            @if($contact->user_id)
                                <input type="text" class="form-control" value="{{ $contact->User->email }}" readonly>
                            @else
                                <input type="text" class="form-control" value="{{ $contact->email }}" readonly>
                            @endif
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.contacts.mobile') }} :</label>
                        <div class="col-lg-9">
                            @if($contact->user_id)
                                <input type="text" class="form-control" value="{{ $contact->User->mobile }}" readonly>
                            @else
                                <input type="text" class="form-control" value="{{ $contact->mobile }}" readonly>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.contacts.content') }} :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" readonly>{{ $contact->content }}</textarea>
                        </div>
                    </div>
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <a href="{{ route('dashboard.contact.index') }}" class="btn btn-primary text-white"><i class="icon-list2 mr-2"></i>{{ trans('dash.buttons.back_to_list') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-img-actions m-1">
                <img class="card-img img-fluid" src="{{ $contact->attachment_url }}" alt="">
                <div class="card-img-actions-overlay card-img">
                    <a href="{{ $contact->attachment_url }}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                        <i class="icon-plus3"></i>
                    </a>
                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                        <i class="icon-link"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@if($contact->email != null)
{{-- <div class="row">
    <div class="col-md-8">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.contacts.reply_message') }}</h5>                        
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.contact.reply') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">{{ trans('dash.contacts.message') }} :</label>
                        <div class="col-lg-9">
                            <input type="hidden" name="email" class="form-control" value="{{ $contact->email }}" readonly>
                            <textarea rows="3" cols="5" name="reply_message" class="form-control" placeholder="{{ trans('dash.contacts.message') }}"></textarea>
                        </div>
                    </div>                                       
                    <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="icon-paperplane mr-2"></i>{{ trans('dash.buttons.send') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->
    </div>
</div> --}}
@endif
@endsection