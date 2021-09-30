<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="header-elements">
            <img width="400" src="{{ asset('assets/global') }}/images/logos/header.png"  />
        </div>
        <div class="clock">
            <div id="Date"></div>
            <ul>
                <li id="hours"></li>
                <li id="point">:</li>
                <li id="min"></li>
                <li id="point">:</li>
                <li id="sec"></li>
            </ul>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('dashboard.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>{{ trans('dash.navbar.main_page') }}</a>
                @yield('sidebar_title')
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="{{ route('dashboard.contact.index') }}" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    {{ trans('dash.contacts.contacts') }}
                </a>                
                <a href="{{ route('dashboard.setting.index') }}" class="breadcrumb-elements-item">
                    <i class="icon-gear mr-2"></i>
                    {{ trans('dash.settings.settings') }}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->