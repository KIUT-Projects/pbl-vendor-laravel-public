@extends('layouts.admin')

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header">{{ __('Customers') }}</h5>
        <div class="d-flex align-self-end px-5">
            <a href="{{ route('customer.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Birthday') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($customers as $customer)
                <tr>
                    <td>
                        <strong>{{ $customer->id }}</strong>
                    </td>
                    <td>
                        <img src="{{ asset($customer->image) }}" class="img-fluid" style="width: 5rem;">
                    </td>
                    <td>
                        <a href="{{ route('customer.show', $customer->id) }}">{{ $customer->name }}</a>
                    </td>
                    <td>
                        {{ $customer->phone }}
                    </td>
                    <td>
                        {{ $customer->address }}
                    </td>
                    <td>
                        {{ $customer->birthday }}
                    </td>
                    <td>
                        <span class="badge bg-label-primary me-1">{{ __('Active') }}</span>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::make($customer->created_at)->format('d.m.Y H:i') }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('customer.show', $customer->id) }}">
                                    <i class="ti ti-eye me-1"></i>
                                    {{ __('Show') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('customer.edit', $customer->id) }}">
                                    <i class="ti ti-pencil me-1"></i>
                                    {{ __('Edit') }}
                                </a>
                                <form method="POST" action="{{ route('customer.destroy', $customer->id) }}">
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
                {{ $customers->links() }}
            </div>

        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection
