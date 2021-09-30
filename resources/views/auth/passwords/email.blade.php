@extends('site.master')
@section('content')
    {{--  ================================ header ================================  --}}
    <div class="second-header">
        <div class="container-fluid">
            <div class="page-header flex-column">
                <h3 class="main-title white-font">تسجيل دخول</h3>
            </div>
            @include('site.layouts.header.logo-block')
        </div>
    </div>

    {{--  ================================ page content ================================  --}}
    <main>
        <section class="main-section">
            <div class="container-fluid">
                <div class="row align-items-center">
                    @include('site.layouts.banner.right_side')
                    <div class="col-md-8 col-xs-12">
                        <div class="center half-width">
                            <div class="logo-block">
                                <a href="{{ route('website.home') }}" class="navbar-barnd">
                                    <img src="{{ asset('site') }}/assets/img/logo/logo.png" alt="Smart Map" class="img-fluid">
                                </a>
                            </div>
                            <form action="{{ route('password.email') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-block white-bg rounded colored login-block">
                                    <div class="form-group inpt-required">
                                        <input type="text" name="username" value="{{ request()->email??old('email') }}" class="form-control blue-bg" placeholder="{!! trans('dash.auth.email_or_mobile') !!}">
                                    </div>
                                    <a href="{{ route('website.login') }}" class="green-font">{!! trans('dash.auth.login') !!}</a>
                                </div>
                                <button type="submit" class="btn white-gradient all-radius main-color btn-lg btn-block w-margin">{!! trans('dash.auth.passwords.password_recovery') !!}</button>
                            </form>
                            <p class="white-color login-text">ليس لديك حساب؟ <a href="{{ route('website.register') }}" class="white-color">إنشاء
                                    حساب</a></p>
                        </div>
                    </div>
                    @include('site.layouts.banner.left_side')
                </div>
            </div>
        </section>
    </main>

    {{--  ================================ news ================================  --}}
    @include('site.layouts.news')
@endsection
