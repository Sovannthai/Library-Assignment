@extends('backends.master')
@section('page_title')
    Admin Dashboard
@endsection
@push('css')
@endpush
<style>
    .home-dash {
        transition: 0.1s;
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
        <div>
            <h3>@lang('Welcome'), {{ auth()->user()->name }}</h3>
        </div>
        <!-- Content Row -->
        @if (auth()->user()->can('view.dash'))
            <div class="row">
                <!-- Income -->
                {{-- <div class="col-xl-3 col-md-6 mb-4">
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
                                    <i class="fas fa-database fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-xl-3 col-md-6 mb-4">
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
                </div> --}}
                <!-- Book -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card custom-border border-left-success border-danger shadow h-100 py-2 home-dash">
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
                {{-- <div class="col-xl-3 col-md-6 mb-4">
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
                </div> --}}
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
            <section class=" col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Top Borrow Book
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
                                <canvas id="bar-chart"></canvas>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-md-4">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Top Views of month
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
                            <canvas id="myChart" width="1448" height="730px"
                                style="display: block; height: 390px; width: 1159px;"></canvas>
                        </div>
                    </div>
                </div> --}}
                </div>
            </section>
        @endif
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('bar-chart').getContext('2d');
            var topBooks = @json($topBooks); // Convert PHP array to JavaScript array

            var bookCodes = [];
            var borrowCounts = [];
            var bookDescriptions = [];

            topBooks.forEach(function(book) {
                bookCodes.push(book.book_code);
                borrowCounts.push(book.borrow_count);
                bookDescriptions.push(book.description);
            });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Top 1', 'Top 2', 'Top 3', 'Top 4', 'Top 5'],
                    datasets: [{
                        label: 'Top Books by Borrow Count',
                        data: borrowCounts,
                        backgroundColor: [
                            'rgba(31, 58, 147, 1)',
                            'rgba(37, 116, 169, 1)',
                            'rgba(92, 151, 191, 1)',
                            'rgb(200, 247, 197)',
                            'rgb(77, 175, 124)',
                            'rgb(30, 130, 76)'
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
                                    return 'Book Code: ' + bookCodes[index] + ',Total Borrow: ' +
                                        borrowCounts[index];
                                },
                                afterLabel: function(tooltipItem) {
                                    var index = tooltipItem.dataIndex;
                                    return bookDescriptions[index];
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
