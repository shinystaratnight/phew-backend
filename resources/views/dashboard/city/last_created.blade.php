<div class="col-md-5">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.city.latest_cities') }}</h5>                
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.country.country') }}</th>
                    <th>{{ trans('dash.city.city') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latest_cities as $city)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $city->country->name }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->created_at->diffforHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>