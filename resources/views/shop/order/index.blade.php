@extends('layouts.admin')

@section('page_js')
    <script src="{{ asset('assets/js/app-user-list.js') }}"></script>
@endsection

@section('content')

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">{{ __('Orders') }}</h5>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table border-top">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <strong>#{{ 1000+$order->id }}</strong>
                        </td>
                        <td>
                            <a href="{{ route('order.show', $order->id) }}">{{ $order->user->name ?? 'Customer'}}</a>
                        </td>
                        <td>
                            {{ price($order->price ?? '0') }}
                        </td>
                        <td>
                            <span class="badge bg-label-primary me-1">{{ __('Paid') }}</span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::make($order->created_at)->format('d.m.Y H:i') }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('order.show', $order->id) }}">
                                        <i class="ti ti-eye me-1"></i>
                                        {{ __('Show') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('order.edit', $order->id) }}">
                                        <i class="ti ti-pencil me-1"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('order.destroy', $order->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="dropdown-item delete-user">
                                            <i class="ti ti-trash me-1"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="pagination text-center d-flex justify-content-center m-3">
                {{ $orders->links() }}
            </div>


        </div>

    </div>
@endsection
