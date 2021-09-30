<div class="col-md-5">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.package.latest_packages') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.package.name') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latest_packages as $package)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->name }}</td>
                        <td>{{ $package->created_at->diffforHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>