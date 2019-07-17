@extends('layouts.app', ['title' => 'Systeem notificaties'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Systeem notificaties</h1>
            <div class="page-subtitle">Verzonden notificaties</div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidenav --}}
                @include ('notifications.kiosk._partials.sidenav')
            </div> {{-- /// END sidenav --}}

            <div class="col-9"> {{-- content --}}
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">Verzonden systeem notificaties.</h6>
                    @include('flash::message') {{-- Flash session view partial --}}

                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-2">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="row">Verzonden door</th>
                                    <th class="border-top-0" scope="row">Verzend methode</th>
                                    <th class="border-top-0" scope="row">Titel</th>
                                    <th class="border-top-0" scope="row">Datum</th>
                                    <th class="border-top-0" scope="row">&nbsp;</th> {{-- Column specified for the method shortcuts --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notifications as $notification) {{-- Loop trough the system notifications --}}
                                    <tr>
                                        <td class="font-weight-bold">
                                            <a href="{{ route('users.show', $notification->creator) }}" class="text-decoration-none text-dark">
                                                {{ $notification->creator->name }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="badge badge-info text-white">
                                                {{ ($notification->driver === 'database') ? 'Applicatie' : ucfirst($notification->driver) }}
                                            </span>
                                        </td>
                                        <td> {{ ucfirst($notification->title) }}</td>
                                        <td>{{ $notification->created_at->format('d-m-Y h:i:s') }}</td>

                                        <td>
                                            <span class="float-right">
                                                <a href="{{ route('alerts.show', $notification) }}" class="text-decoration-none text-secondary">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @empty {{-- No notification are found --}}
                                @endforelse {{-- /// END notification loop --}}
                            </tbody>
                        </table> 
                    </div>

                    {{ $notifications->links() }} {{-- Pagination view instance --}}
                </div>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection