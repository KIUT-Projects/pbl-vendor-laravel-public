@extends('layouts.admin')

@section('page_js')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\Order::count() }} <b>+{{ \App\Models\Order::whereDate('created_at', today())->count() }}</b></h5>
                  <small>{{ __('Orders') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-success rounded-pill p-2">
                    <i class="fa-regular fa-envelope-open-dollar"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\Product::count() }} <b>+{{ \App\Models\Product::whereDate('created_at', today())->count() }}</b></h5>
                  <small>{{ __('Products') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-warning rounded-pill p-2">
                    <i class="fa-regular fa-boxes-stacked"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h5 class="mb-0 me-2">{{ \App\Models\Brand::count() }} <b>+{{ \App\Models\Brand::whereDate('created_at', today())->count() }}</b></h5>
                  <small>{{ __('Brands') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-danger rounded-pill p-2">
                    <i class="fa-regular fa-copyright"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\Category::count() }} <b>+{{ \App\Models\Category::whereDate('created_at', today())->count() }}</b></h5>
                  <small>{{ __('Categories') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-primary rounded-pill p-2">
                    <i class="fa-regular fa-rectangle-history"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\Supplier::count() }}</h5>
                  <small>{{ __('Suppliers') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-primary rounded-pill p-2">
                    <i class="fa-regular fa-boxes-stacked"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\Role::count() }}</h5>
                  <small>{{ __('Roles') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-secondary rounded-pill p-2">
                    <i class="fa-regular fa-person-military-rifle"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\Customer::count() }}</h5>
                  <small>{{ __('Customers') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-info rounded-pill p-2">
                    <i class="fa-regular fa-users-line"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                  <h5 class="mb-0 me-2">{{ \App\Models\User::count() }}</h5>
                  <small>{{ __('Users') }}</small>
                </div>
                <div class="card-icon">
                  <span class="badge bg-label-success rounded-pill p-2">
                    <i class="fa-regular fa-user-pilot-tie"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="row">

        @php
            $weekly_sell = (object)[
                'total' => "85 450 000 UZS"
            ];
        @endphp

        <!-- Earning Reports -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">{{ __('Earning Reports')}}</h5>
                        <small class="text-muted">{{ __('Weekly Earnings Overview')}}</small>
                    </div>
                    <div class="dropdown">
                        <button
                            class="btn p-0"
                            type="button"
                            id="earningReportsId"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                            <a class="dropdown-item" href="javascript:void(0);">{{ __('View More')}}</a>
                            <a class="dropdown-item" href="javascript:void(0);">{{ __('Delete')}}</a>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                            <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                                <h1 class="mb-0" style="    font-size: 1rem;
    font-weight: bolder;">{{ $weekly_sell->total }}</h1>
                                <div class="badge rounded bg-label-success">+4.2%</div>
                            </div>
                            <small class="text-muted">{{ __('You informed of this week compared to last week')}}</small>
                        </div>
                        <div class="col-12 col-md-8">
                            <div id="weeklyEarningReports"></div>
                        </div>
                    </div>
                    <div class="border rounded p-3 mt-2">
                        <div class="row gap-4 gap-sm-0">
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-primary p-1">
                                        <i class="ti ti-currency-dollar ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">{{ __('Earnings')}}</h6>
                                </div>
                                <h4 class="my-2 pt-1">$545.69</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: 65%"
                                        aria-valuenow="65"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                                    <h6 class="mb-0">{{ __('Profit')}}</h6>
                                </div>
                                <h4 class="my-2 pt-1">$256.34</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div
                                        class="progress-bar bg-info"
                                        role="progressbar"
                                        style="width: 50%"
                                        aria-valuenow="50"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-danger p-1">
                                        <i class="ti ti-brand-paypal ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0">{{ __('Expense')}}</h6>
                                </div>
                                <h4 class="my-2 pt-1">$74.19</h4>
                                <div class="progress w-75" style="height: 4px">
                                    <div
                                        class="progress-bar bg-danger"
                                        role="progressbar"
                                        style="width: 65%"
                                        aria-valuenow="65"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Earning Reports -->

        <!-- Support Tracker -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">{{ __('Support Tracker')}}</h5>
                        <small class="text-muted">{{ __('Last 7 Days')}}</small>
                    </div>
                    <div class="dropdown">
                        <button
                            class="btn p-0"
                            type="button"
                            id="supportTrackerMenu"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                            <a class="dropdown-item" href="javascript:void(0);">{{ __('View More')}}</a>
                            <a class="dropdown-item" href="javascript:void(0);">{{ __('Delete')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                            <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                <h1 class="mb-0">164</h1>
                                <p class="mb-0">{{ __('Total Tickets')}}</p>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                    <div class="badge rounded bg-label-primary p-1"><i class="ti ti-ticket ti-sm"></i></div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap">{{ __('New Tickets')}}</h6>
                                        <small class="text-muted">142</small>
                                    </div>
                                </li>
                                <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                    <div class="badge rounded bg-label-info p-1">
                                        <i class="ti ti-circle-check ti-sm"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap">{{ __('Open Tickets')}}</h6>
                                        <small class="text-muted">28</small>
                                    </div>
                                </li>
                                <li class="d-flex gap-3 align-items-center pb-1">
                                    <div class="badge rounded bg-label-warning p-1"><i class="ti ti-clock ti-sm"></i></div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap">{{ __('Response Time')}}</h6>
                                        <small class="text-muted">{{ __('1 Day')}}</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                            <div id="supportTracker"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Support Tracker -->

    </div>
@endsection
