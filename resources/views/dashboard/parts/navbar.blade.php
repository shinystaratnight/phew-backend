<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark navbar-static" style="background-color: #de1d30">
    <div class="navbar-text col-2">
        <a href="{{ route('dashboard.home') }}" class="d-inline-block">
            {{ settings('dashboard_name_' . app()->getLocale()) }}
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="navbar-text ml-md-3">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            {{ trans('dash.navbar.welcome') }} {{ auth()->user()->fullname }}
        </span>

        <ul class="navbar-nav ml-md-auto">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-make-group mr-2"></i>
                    {{ trans('dash.navbar.social_links') }}
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-body p-2">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-6">
                                <a href="{{ settings('facebook_url') }}" target="_blank" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="icon-facebook text-blue-400 icon-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Facebook</div>
                                </a>
                                <a href="{{ settings('instagram_url') }}" target="_blank" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="icon-instagram text-info-400 icon-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Instagram</div>
                                </a>
                            </div>
                                                    
                            <div class="col-12 col-sm-6">
                                <a href="{{ settings('twitter_url') }}" target="_blank" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="icon-twitter text-info-400 icon-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Twitter</div>
                                </a>
                                <a href="{{ settings('youtube_url') }}" target="_blank" class="d-block text-default text-center ripple-dark rounded p-3">
                                    <i class="icon-youtube text-danger icon-2x"></i>
                                    <div class="font-size-sm font-weight-semibold text-uppercase mt-2">Youtube</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('assets/global') }}/images/lang/{{ app()->getLocale() }}.png" class="img-flag mr-2" alt="">
                    {{ LaravelLocalization::getSupportedLocales()[app()->getLocale()]['native'] }}
                </a>
            
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        class="dropdown-item arabic @if($localeCode == app()->getLocale()) active @endif">
                        <img src="{{ asset('assets/global') }}/images/lang/{{ $localeCode }}.png" class="img-flag" alt="">
                        {{ $properties['native'] }}
                    </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.logout') }}" class="navbar-nav-link">
                    <i class="icon-switch2"></i>
                    <span class="d-md-none ml-2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->