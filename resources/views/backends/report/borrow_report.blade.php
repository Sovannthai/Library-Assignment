@extends('backends.master')
@section('title', 'Borrow Report')
@section('contents')
    <div class="card">
        <h5 class="card-header">
            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
                id="heading-example" class="d-block">
                <i class="fa fa-filter"></i>
                @lang('Filter')
            </a>
        </h5>
        <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="customer_id">@lang('Customer')</label>
                        <select id="customer-filter" class="form-control custom-select rounded-0"
                            id="exampleSelectRounded0">
                            <option value="" {{ !request()->filled('customer_id') ? 'selected' : '' }}>
                                @lang('All Customer')
                            </option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-sm-4">
                        <label for="created_by">@lang('Librarain')</label>
                        <select id="created_by-filter" class="form-control custom-select rounded-0"
                            id="exampleSelectRounded0">
                            <option value="" {{ !request()->filled('created_by') ? 'selected' : '' }}>
                                @lang('All')
                            </option>
                            @foreach ($Users as $User)
                                <option value="{{ $User->id }}"
                                    {{ request('created_by') == $User->id ? 'selected' : '' }}>
                                    {{ $User->name }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-4">
                        <label for="filter-text">@lang('Status')</label>
                        <div class="form-group">
                            <form method="GET" action="{{ route('report.index') }}">
                                <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                                    <option value="" {{ $filterValue === null ? 'selected' : '' }}>@lang('All')
                                    </option>
                                    <option value="1" {{ $filterValue == '1' ? 'selected' : '' }}>@lang('Is Borrow')
                                    </option>
                                    <option value="0" {{ $filterValue == '0' ? 'selected' : '' }}>@lang('Is Returned')
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <form id="filterForm" method="GET" action="{{ route('report.index') }}">
                            <div class="col-sm-4">
                                <label for="start_date">@lang('From Date')</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ old('start_date', $request->input('start_date')) }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="end_date">@lang('To Date')</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ old('end_date', $request->input('end_date')) }}">
                            </div>
                            <div class="col-sm-4 mt-2">
                                <button type="button" class="btn btn-outline-danger float-lg-right btn-lg ml-1"
                                    onclick="resetFilter()">@lang('Reset')</button>
                                <button type="submit"
                                    class="btn btn-outline-success float-lg-right btn-lg">@lang('Filter')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">@lang('Borrow Report')</div>
        <div class="card-body">
            <table class="table table-bordered datatable table-hover text-nowrap table-responsive">
                <thead class="">
                    <tr>
                        <th>@lang('No.')</th>
                        <th>@lang('Customer')</th>
                        <th>@lang('Book')</th>
                        <th>@lang('Code')</th>
                        {{-- <th>Book</th> --}}
                        <th>@lang('Deposite Amount')($)</th>
                        <th>@lang('Find Amount')</th>
                        <th>@lang('Borrow Date')</th>
                        <th>@lang('Due Date')</th>
                        <th>@lang('Return Date')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrow_reports as $borrow_report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ @$borrow_report->customer->name }}</td>
                            <td>{{ $borrow_report->book->book_code }} ({{ $borrow_report->book->catelog->cate_name }})
                            </td>
                            <td>{{ @$borrow_report->borrow->borrow_code }}</td>
                            {{-- <td>
                        @foreach ($borrow->book_id as $bookId)
                        @php
                        $book = \App\Models\Book::find($bookId);
                        @endphp
                        @if ($book)
                        <li>
                            {{ $book->book_code }} ({{ @$book->catelog->cate_name }})
                        </li>
                        @endif
                        @endforeach
                    </td> --}}
                            <td>$ {{ $borrow_report->borrow->deposit_amount }}</td>
                            <td>$ {{ $borrow_report->find_amount }}</td>
                            <td>{{ $borrow_report->borrow->borrow_date }}</td>
                            <td>{{ $borrow_report->borrow->due_date }}</td>
                            <td>
                                @if ($borrow_report->borrow->return_date)
                                    {{ $borrow_report->return_date }}
                                @else
                                    <p class="text-secondary">Not Return</p>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-success text-uppercase" data-toggle="modal"
                                    data-target="#show-{{ $borrow_report->id }}" data-toggle="tooltip"
                                    title="@lang('Show')"> @lang('View')</a>&nbsp;&nbsp;
                                @include('backends.report.show_borrow_report')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('js')
        <script>
            function applyFilters() {
                var customer_id = document.getElementById('customer-filter').value;
                var created_by = document.getElementById('created_by-filter').value;
                var url = "{{ route('report.index') }}";
                if (customer_id !== '') {
                    url += "?customer_id=" + customer_id;
                }
                if (created_by !== '') {
                    url += (url.includes('?') ? '&' : '?') + "created_by=" + created_by;
                }
                window.location.href = url;
            }
            document.getElementById('customer-filter').addEventListener('change', applyFilters);
            document.getElementById('created_by-filter').addEventListener('change', applyFilters);
        </script>
        <script>
            function resetFilter() {
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
                window.history.replaceState({}, document.title, window.location.pathname);
                window.location.reload();
            }
        </script>
    @endpush
@endsection
