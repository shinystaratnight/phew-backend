@extends('dashboard.layout')
@section('style')
	<style>
		.scroll-y{
			height: 425px;
			overflow-y: scroll;
			overflow-x: hidden;
		}
		.scroll-y::-webkit-scrollbar {
			width: 5px;
		}
		.scroll-y::-webkit-scrollbar-thumb {
			background-color: #2196f3;
		}
	</style>
@endsection
@section('file_scripts')
	<!-- Theme JS files -->
	<script src="{{ asset('assets/global') }}/js/plugins/visualization/echarts/echarts.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{{ asset('assets/global') }}/js/plugins/media/fancybox.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- /theme JS files -->
@endsection
@section('custom_scripts')
	<script src="{{ asset('assets/global') }}/js/demo_pages/dashboard.js"></script>
	<script src="{{ asset('assets/global') }}/js/demo_pages/gallery_library.js"></script>
	@include('dashboard.home.custom_charts')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			UsersChart.init();
			PostsChart.init();
		});
	</script>
@endsection
@section('page_title')
    {{ trans('dash.navbar.main_page') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ route('dashboard.permission.index') }}">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $permissions_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.permissions_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('dashboard.admin.index') }}">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $admins_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.admins_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('dashboard.client.index') }}">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $clients_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.clients_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('dashboard.contact.index') }}?is_seen=unseen">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $contacts_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.unseen_contacts_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <a href="">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $today_posts_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.today_posts_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $posts_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.posts_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('dashboard.city.index') }}">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $cities_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.cities_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{ route('dashboard.country.index') }}">
                        <div class="card bg-{{ random_colors() }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{ $countries_count }}</h3>
                                </div>
                                <div>
                                    {{ trans('dash.home.countries_count') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card my-card border-right-2 border-left-2 border-right-primary border-left-primary">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">{{ trans('dash.home.movie.popular_movies') }}</h6>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-xl-12">
                            @foreach($movies as $movie)
                                <div class="media flex-column flex-sm-row mt-0 mb-3">
                                    <div class="mr-sm-3 mb-2 mb-sm-0">
                                        <div class="card-img-actions">
                                            @if(isset($movie->movie_detail->poster_path))
                                                <a href="https://image.tmdb.org/t/p/w500{{ $movie->movie_detail->poster_path }}" data-popup="lightbox">
                                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->movie_detail->poster_path }}" alt="" class="img-fluid img-preview rounded">
                                                    <span class="card-img-actions-overlay card-img"><i class="icon-image icon-2x"></i></span>
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/uploads/default.png') }}" data-popup="lightbox">
                                                    <img src="{{ asset('storage/uploads/default.png') }}" style="width: 53.33px; height: 79.98px" alt="" class="img-fluid img-preview rounded">
                                                    <span class="card-img-actions-overlay card-img"><i class="icon-image icon-2x"></i></span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-title"><a href="#">{{ @$movie->movie_detail->original_title }}</a></h6>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item">{{ trans('dash.home.movie.counter') }} : {{ $movie->counter }}</li>
                                        </ul>
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item">{{ trans('dash.home.movie.vote_average') }} : {{ @$movie->movie_detail->vote_average }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-xl-12">
			<div class="card border-right-2 border-left-2 border-right-primary border-left-primary">
				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="customers_chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			<div class="card border-right-2 border-left-2 border-right-primary border-left-primary">
				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height" id="posts_chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <style>
        .my-card{
            height: 390px;
            overflow-y: scroll;
        }
        .my-card::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        .my-card::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        .my-card::-webkit-scrollbar-thumb {
            background: #0aa7ef;
            border-radius: 10px;
        }

        /* Handle on hover */
        .my-card::-webkit-scrollbar-thumb:hover {
            background: #0aa7ef;
        }

    </style>
@endsection
