@extends('backends.master')
@section('page_title')
    Admin Dashboard
@endsection
@push('css')
@endpush
<style>
    .home-dash {
        transition: 0.5s;
    }

    .home-dash:hover {
        transform: 1.5s;
        transform: translateY(-15px);
    }

    .home-dash-3 {
        transition: 0.5s;
    }

    .home-dash-3:hover {
        transform: 1.5s;
        transform: translateY(15px);
    }
</style>
@section('contents')
    <div class="container-fluid">
        <div>
            <h3>@lang('Welcome'), {{ auth()->user()->name }}</h3>
        </div>
        <!-- Content Row -->
        @if (auth()->user()->can('view.dash'))
            <div class="row">
                <!-- Income -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        @lang('Total Librarian')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-user-group fa-2x text-gray-300"></i>
                                    {{-- <i class="fas fa-database fa-2x text-gray-300"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        @lang('Catelog')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $catelogs }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Book -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        @lang('Book')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $books }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Expense Requests -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        @lang('Book Borrow')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBookCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fas fa-exchange-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Customers -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        @lang('Customer')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customer }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Deposite Amount --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        @lang('Deposite Amount')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $deposte_amount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-hand-holding-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Find Amount --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        @lang('Find Amount')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $find_amount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-circle-dollar-to-slot fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/charts/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/charts/chart-pie-demo.js') }}"></script>
@endpush
