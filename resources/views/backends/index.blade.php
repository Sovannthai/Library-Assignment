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
        border: 3px solid #2e3ff6 !important;
        transform: 1.5s;
        transform: translateY(-15px);
    }

    .home-dash-3 {
        transition: 0.5s;
    }

    .home-dash-3:hover {
        border: 3px solid #2e3ff6 !important;
        transform: 1.5s;
        transform: translateY(15px);
    }
</style>
@section('contents')
    <div class="container-fluid">
        <div class="mb-3">
            <h3>@lang('Welcome'), {{ auth()->user()->name }}</h3>
        </div>
        <!-- Content Row -->
        @if (auth()->user()->can('view.dash'))
            {{-- <form action="{{ route('home') }}" method="GET">
                <div class="row">
                    <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="filter" value="day" autocomplete="off"
                                {{ $filter == 'day' ? 'checked' : '' }}> Today
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="filter" value="week" autocomplete="off"
                                {{ $filter == 'week' ? 'checked' : '' }}> This Week
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="filter" value="month" autocomplete="off"
                                {{ $filter == 'month' ? 'checked' : '' }}> This Month
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="filter" value="year" autocomplete="off"
                                {{ $filter == 'year' ? 'checked' : '' }}> This Year
                        </label>
                    </div>
                    <div class=" btn-group-toggle mb-4" data-toggle="buttons">
                        <button type="submit" class="btn btn-outline-secondary ml-2 text-uppercase">Filter</button>
                        <a href="{{ route('home') }}" class="btn btn-outline-danger text-uppercase">Reset</a>
                    </div>
                </div>
            </form> --}}
            <div class="row">
                <!-- Book -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card custom-border border-left-success border-danger shadow h-100 py-2 home-dash">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        @lang('Book Borrow')</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="book-count">{{ $borrow_books }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $deposit_amount }}</div>
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
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">
                                <i class="far fa-chart-bar"></i>
                                Top 5 Borrow Book
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="bar-chart" width="auto" height="auto"></canvas>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">
                                <i class="far fa-chart-bar"></i>
                                Current Year Total Borrow Book
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="auto" height="auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('bar-chart').getContext('2d');
            var topBooks = @json($topBooks);

            var bookCodes = [];
            var borrowCounts = [];
            var bookDescriptions = [];

            topBooks.forEach(function(book) {
                bookCodes.push(book.book_code);
                borrowCounts.push(book.borrow_count);
                bookDescriptions.push(book.description);
            });

            var myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ['Top 1', 'Top 2', 'Top 3', 'Top 4', 'Top 5'],
                    datasets: [{
                        label: 'Top 5 Borrow Book',
                        data: borrowCounts,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(75, 192, 192)',
                            'rgb(255, 205, 86)',
                            'rgb(201, 203, 207)',
                            'rgb(54, 162, 235)'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var index = tooltipItem.dataIndex;
                                    return 'Book Code: ' + bookCodes[index] + ', Total Borrow: ' +
                                        borrowCounts[index];
                                },
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var monthlyData = @json(array_values($monthlyData));

            var data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Borrow Book',
                    data: monthlyData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            };
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
