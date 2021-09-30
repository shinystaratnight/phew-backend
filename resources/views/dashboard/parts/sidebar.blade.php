<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-right8"></i>
        </a>
        <span class="font-weight-semibold">{{ trans('dash.sidebar.main_menu') }}</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body"
                style="background:url({{ asset('assets/global') }}/images/backgrounds/user_bg4.jpg) center no-repeat; background-size: cover;">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="{{ auth()->user()->profile_image }}"
                            class="img-fluid rounded-circle shadow-1 mb-3 bg-white" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">{{ auth()->user()->fullname }}</h6>
                    <span class="font-size-sm text-white text-shadow-dark">{{ auth()->user()->role->name }}</span>
                </div>
                <div class="sidebar-user-material-footer">
                    <a href="#user-nav"
                        class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle"
                        data-toggle="collapse"><span>{{ trans('dash.sidebar.my_account') }}</span></a>
                </div>
            </div>
            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="{{ route('dashboard.admin.profile') }}" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>{{ trans('dash.sidebar.my_profile') }}</span>
                        </a>
                    </li>
                    {{--  <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-comment-discussion"></i>
                            <span>{{ trans('dash.sidebar.my_messages') }}</span>
                    <span class="badge bg-teal-400 badge-pill align-self-center ml-auto">58</span>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-cog5"></i>
                            <span>{{ trans('dash.sidebar.my_settings') }}</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('dashboard.logout') }}" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>{{ trans('dash.auth.logout') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{ trans('dash.sidebar.main_menu') }}</div>
                    <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.home') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.home' ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>
                            {{ trans('dash.sidebar.main_page') }}
                        </span>
                    </a>
                </li>
                {{--  Permissions  --}}
                <li
                    class="nav-item nav-item-submenu {{ request()->is('dashboard/permission/*') || request()->is('dashboard/permission') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-tree7"></i>
                        <span>{{ trans('dash.permissions.permissions') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="permissions">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.permission.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.permission.index' ? 'active' : '' }}">
                                {{ trans('dash.permissions.all_permissions') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.permission.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.permission.create' ? 'active' : '' }}">
                                {{ trans('dash.permissions.add_new_permission') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Admins  --}}
                <li
                    class="nav-item nav-item-submenu {{ request()->is('dashboard/admin/*') || request()->is('dashboard/admin') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icofont-users-alt-2"></i>
                        <span>{{ trans('dash.admins.admins') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="admins">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.admin.index' ? 'active' : '' }}">
                                {{ trans('dash.admins.all_admins') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.admin.create' ? 'active' : '' }}">
                                {{ trans('dash.admins.add_new_admin') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{ trans('dash.sidebar.users_section') }}
                    </div>
                    <i class="icon-menu" title="Users section"></i>
                </li>
                {{--  Clients  --}}
                {{-- <li class="nav-item nav-item-submenu {{ request()->is('dashboard/client/*') || request()->is('dashboard/client') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.client.index' ? 'active' : '' }}"><i
                            class="icon-people"></i> <span>{{ trans('dash.client.clients') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="clients">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.client.index') }}" class="nav-link">
                                {{ trans('dash.client.all_clients') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.client.index') }}?gender=male" class="nav-link ">
                                {{ trans('dash.client.male_clients') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.client.index') }}?gender=female" class="nav-link ">
                                {{ trans('dash.client.female_clients') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.client.create') }}" class="nav-link">
                                {{ trans('dash.client.add_new_client') }}
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- @dd(isset(request()->gender)) --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.client.index') }}"
                        class="nav-link {{ (request()->route()->getName() == 'dashboard.client.index') && (request()->gender == null) ? 'active' : '' }}"><i
                            class="icon-users2"></i> <span>{{ trans('dash.client.all_clients') }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.client.index') }}?gender=male"
                        class="nav-link {{ (request()->route()->getName() == 'dashboard.client.index') && (request()->gender == 'male') ? 'active' : '' }}"><i
                            class="icon-users2"></i> <span>{{ trans('dash.client.male_clients') }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.client.index') }}?gender=female"
                        class="nav-link {{ (request()->route()->getName() == 'dashboard.client.index') && (request()->gender == 'female') ? 'active' : '' }}"><i
                            class="icon-users2"></i> <span>{{ trans('dash.client.female_clients') }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.client.create') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.client.create' ? 'active' : '' }}"><i
                            class="icon-user-plus"></i> <span>{{ trans('dash.client.add_new_client') }}</span></a>
                </li>
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{ trans('dash.sidebar.other_sections') }}
                    </div>
                    <i class="icon-menu" title="Users section"></i>
                </li>
                {{--  Posts  --}}
                <li
                    class="nav-item nav-item-submenu {{ request()->is($locale . '/dashboard/post/*') || request()->is($locale . '/dashboard/post') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-images3"></i>
                        <span>{{ trans('dash.post.posts') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="posts">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.post.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.post.index' ? 'active' : '' }}">
                                {{ trans('dash.post.all_posts') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.post.index') }}?activity=normal" class="nav-link {{ (request()->route()->getName() == 'dashboard.post.index') && (request()->activity == 'normal') ? 'active' : '' }}">
                                <span>{{ trans('dash.post.activity_types.normal_posts') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.post.index') }}?activity=location" class="nav-link {{ (request()->route()->getName() == 'dashboard.post.index') && (request()->activity == 'location') ? 'active' : '' }}">
                                <span>{{ trans('dash.post.activity_types.location_posts') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.post.index') }}?activity=watching" class="nav-link {{ (request()->route()->getName() == 'dashboard.post.index') && (request()->activity == 'watching') ? 'active' : '' }}">
                                <span>{{ trans('dash.post.activity_types.watching_posts') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Sponsors  --}}
                <li class="nav-item nav-item-submenu {{ request()->is($locale . '/dashboard/sponsor/*') || request()->is($locale . '/dashboard/sponsor') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-price-tags"></i>
                        <span>{{ trans('dash.sponsor.sponsors') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="sponsors">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.sponsor.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.sponsor.index' ? 'active' : '' }}">
                                {{ trans('dash.sponsor.all_sponsors') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.sponsor.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.sponsor.create' ? 'active' : '' }}">
                                {{ trans('dash.sponsor.add_new_sponsor') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Ads  --}}
                <li class="nav-item nav-item-submenu {{ request()->is($locale . '/dashboard/ad/*') || request()->is($locale . '/dashboard/ad') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-megaphone"></i>
                        <span>{{ trans('dash.ad.ads') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="ads">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.ad.index') }}"
                               class="nav-link {{ request()->route()->getName() == 'dashboard.ad.index' ? 'active' : '' }}">
                                {{ trans('dash.ad.all_ads') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.ad.create') }}"
                               class="nav-link {{ request()->route()->getName() == 'dashboard.ad.create' ? 'active' : '' }}">
                                {{ trans('dash.ad.add_new_ad') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Packages  --}}
                <li
                    class="nav-item nav-item-submenu {{ request()->is($locale . '/dashboard/package/*') || request()->is($locale . '/dashboard/package') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-price-tags"></i>
                        <span>{{ trans('dash.package.packages') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="packages">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.package.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.package.index' ? 'active' : '' }}">
                                {{ trans('dash.package.all_packages') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.package.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.package.create' ? 'active' : '' }}">
                                {{ trans('dash.package.add_new_package') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Countries  --}}
                <li class="nav-item nav-item-submenu {{ request()->is('dashboard/country/*') || request()->is('dashboard/country') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-earth"></i>
                        <span>{{ trans('dash.country.countries') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="countries">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.country.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.country.index' ? 'active' : '' }}">
                                {{ trans('dash.country.all_countries') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.country.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.country.create' ? 'active' : '' }}">
                                {{ trans('dash.country.add_new_country') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Cities  --}}
                <li
                    class="nav-item nav-item-submenu {{ request()->is('dashboard/city/*') || request()->is('dashboard/city') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-flag3"></i>
                        <span>{{ trans('dash.city.cities') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="cities">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.city.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.city.index' ? 'active' : '' }}">
                                {{ trans('dash.city.all_cities') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.city.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.city.create' ? 'active' : '' }}">
                                {{ trans('dash.city.add_new_city') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Nationalities  --}}
                <li class="nav-item nav-item-submenu {{ request()->is('dashboard/nationality/*') || request()->is('dashboard/nationality') ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-earth"></i>
                        <span>{{ trans('dash.nationality.nationalities') }}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="nationalities">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.nationality.index') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.nationality.index' ? 'active' : '' }}">
                                {{ trans('dash.nationality.all_nationalities') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.nationality.create') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.nationality.create' ? 'active' : '' }}">
                                {{ trans('dash.nationality.add_new_nationality') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--  Common Questions  --}}
                {{--  <li class="nav-item nav-item-submenu {{ request()->is('dashboard/common_question/*') || request()->is('dashboard/common_question') ? 'nav-item-expanded nav-item-open' : '' }}">
                <a href="#" class="nav-link"><i class="icon-question3"></i>
                    <span>{{ trans('dash.common_question.common_questions') }}</span></a>
                <ul class="nav nav-group-sub" data-submenu-title="common_questions">
                    <li class="nav-item">
                        <a href="{{ route('dashboard.common_question.index') }}"
                            class="nav-link {{ request()->route()->getName() == 'dashboard.common_question.index' ? 'active' : '' }}">
                            {{ trans('dash.common_question.all_common_questions') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.common_question.create') }}"
                            class="nav-link {{ request()->route()->getName() == 'dashboard.common_question.create' ? 'active' : '' }}">
                            {{ trans('dash.common_question.add_new_common_question') }}
                        </a>
                    </li>
                </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.contact.index') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.contact.index' ? 'active' : '' }}"><i
                            class="icon-comment-discussion"></i> <span>{{ trans('dash.contacts.contacts') }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.setting.index') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.setting.index' ? 'active' : '' }}"><i
                            class="icon-gear"></i> <span>{{ trans('dash.settings.settings') }}</span></a>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->
</div>
<!-- /main sidebar
