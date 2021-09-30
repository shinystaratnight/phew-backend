<div class="col-md-5">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{ trans('dash.client.latest_clients') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ trans('dash.user_data.profile_image') }}</th>
                    <th>{{ trans('dash.user_data.username') }}</th>
                    <th>{{ trans('dash.user_data.mobile') }}</th>
                    <th>{{ trans('dash.table.created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($last_clients as $client)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $client->profile_image }}" data-popup="lightbox">
                                <img src="{{ $client->profile_image }}" alt="" class="img-preview rounded">
                            </a>
                        </td>
                        <td>
                            @if($client->username)
                                <a href="{{ route('dashboard.client.show', $client->id) }}" class="text-default font-weight-bold">{{ $client->username }}</a>
                            @else
                                {{ trans('dash.messages.not_entered') }}
                            @endif
                        </td>
                        <td>
                            @if($client->mobile)
                                <a href="tel:{{ $client->mobile }}">{{ $client->mobile }}</a></td>
                            @else
                                {{ trans('dash.messages.not_entered') }}
                            @endif
                            
                        <td>{{ $client->created_at->diffforHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>