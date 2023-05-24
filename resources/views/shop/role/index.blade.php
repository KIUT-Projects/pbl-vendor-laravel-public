@extends('layouts.admin')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>{{ __('All roles') }}</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $roles->total() }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                          <i class="ti ti-user ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>{{ __('Active roles') }}</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{ $roles->total() }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                          <i class="ti ti-user-plus ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header">{{ __('Roles') }}</h5>
        <div class="d-flex align-self-end px-5">
            <a href="{{ route('role.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
<!--                    <th>{{ __('Permissions') }}</th>-->
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($roles as $role)
                <tr>
                    <td>
                        <strong>{{ $role->id }}</strong>
                    </td>
                    <td>
                        <a href="{{ route('role.show', $role->id) }}">{{ $role->name }}</a>
                    </td>
<!--                    <td>
{{--                        {{ $role?->permissions ?? __('Empty') }}--}}
                    </td>-->
{{--                    <td>--}}
{{--                        {{ $role->user?->name ?? __('Empty') }}--}}
{{--                    </td>--}}
                    <td>
                        <span class="badge bg-label-primary me-1">{{ __('Active') }}</span>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::make($role->created_at)->format('d.m.Y H:i') }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('role.show', $role->id) }}">
                                    <i class="ti ti-eye me-1"></i>
                                    {{ __('Show') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('role.edit', $role->id) }}">
                                    <i class="ti ti-pencil me-1"></i>
                                    {{ __('Edit') }}
                                </a>
                                <form method="POST" action="{{ route('role.destroy', $role->id) }}">
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
                {{ $roles->links() }}
            </div>

        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection
