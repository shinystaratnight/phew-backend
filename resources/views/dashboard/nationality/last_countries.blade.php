<div class="col-md-5">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.nationality.latest_nationalities') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.nationality.flag') }}</th>
                    <th>{{ trans('dash.nationality.name') }}</th>
                    <th>{{ trans('dash.nationality.phonecode') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latest_nationalities as $nationality)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $nationality->flag_url }}" data-popup="lightbox">
                                <img src="{{ $nationality->flag_url }}" alt="" width="80" height="70" class="img-preview rounded">
                            </a>
                        </td>
                        <td>{{ $nationality->name }}</td>
                        <td>{{ $nationality->phonecode }}</td>
                        <td>{{ $nationality->created_at->diffforHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>