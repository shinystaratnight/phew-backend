<div class="col-md-5">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.country.latest_countries') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.country.flag') }}</th>
                    <th>{{ trans('dash.country.name') }}</th>
                    <th>{{ trans('dash.country.phonecode') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latest_countries as $country)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $country->flag_url }}" data-popup="lightbox">
                                <img src="{{ $country->flag_url }}" alt="" width="80" height="70" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->phonecode }}</td>
                        <td>{{ $country->created_at->diffforHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>