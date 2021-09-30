@extends('dashboard.layout')
@section('file_scripts')
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switch.min.js"></script>
@endsection

@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/form_layouts.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/datatables_basic.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_select2.js"></script>
    <script src="{{ asset('assets/global') }}/js/demo_pages/form_checkboxes_radios.js"></script>
    <script>
        $(document).ready(function(){
            $('.form-check-input-switchery').click(function(){
                if($(this).is(':checked')){
                    $(this).parent().next().attr('checked', true);
                }else{
                    $(this).parent().next().attr('checked', false);
                }
            });
        });
    </script>
@endsection
@section('page_title')
{{ trans('dash.permissions.add_new_permission') }}
@endsection
@section('sidebar_title')
    <a href="{{ route('dashboard.permission.index') }}" class="breadcrumb-item">{{ trans('dash.permissions.permissions') }}</a>
    <span class="breadcrumb-item active">{{ trans('dash.permissions.add_new_permission') }}</span>
@endsection
@section('content')
<!-- Vertical form options -->
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ trans('dash.permissions.permission_data') }}</h5>                        
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.permission.store') }}" method="POST">
                    {{ csrf_field() }}
                    @include('dashboard.permission.form')
                </form>
            </div>
        </div>
        <!-- /basic layout -->
    </div>
</div>
<!-- /vertical form options -->    
@endsection