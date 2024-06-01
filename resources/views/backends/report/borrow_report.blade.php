@extends('backends.master')
@section('title', 'Borrow Report')
@section('contents')
<div class="card">
    <h5 class="card-header">
        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example" id="heading-example" class="d-block">
            <i class="fa fa-filter"></i>
            Filter
        </a>
    </h5>
    <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label for="customer_id">Customer</label>
                    <select id="customer-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                        <option value="" {{ !request()->filled('customer_id') ? 'selected' : '' }}>All Customer
                        </option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col-md-4">
                    <label for="filter-text">Catelog</label>
                    <div class="form-group">
                        <form method="GET" action="{{ route('report.index') }}">
                <select name="cate_id" id="cate_id" class="form-control" onchange="this.form.submit()">
                    <option value="" {{ $cateId === null ? 'selected' : '' }}>All</option>
                    @foreach($catelogs as $id => $cate_id)
                    <option value="{{ $id }}" {{ $cateId == $id ? 'selected' : '' }}>{{ $cate_id->cate_name }}</option>
                    @endforeach
                </select>
                </form>
            </div>
        </div> --}}
        <div class="col-sm-4">
            <label for="created_by">Librarain</label>
            <select id="created_by-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                <option value="" {{ !request()->filled('created_by') ? 'selected' : '' }}>All
                </option>
                @foreach ($Users as $User)
                <option value="{{ $User->id }}" {{ request('created_by') == $User->id ? 'selected' : '' }}>
                    {{ $User->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="filter-text">Status</label>
            <div class="form-group">
                <form method="GET" action="{{ route('report.index') }}">
                    <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                        <option value="" {{ $filterValue === null ? 'selected' : '' }}>All</option>
                        <option value="1" {{ $filterValue == '1' ? 'selected' : '' }}>Is Borrow</option>
                        <option value="0" {{ $filterValue == '0' ? 'selected' : '' }}>Is Returned</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="col-sm-12">
            <form id="filterForm" method="GET" action="{{ route('report.index') }}">
                <div class="col-sm-4">
                    <label for="start_date">From Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $request->input('start_date')) }}">
                </div>
                <div class="col-sm-4">
                    <label for="end_date">To Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $request->input('end_date')) }}">
                </div>
                <div class="col-sm-4 mt-2">
                    <button type="button" class="btn btn-outline-danger float-lg-right btn-lg ml-1" onclick="resetFilter()">Reset</button>
                    <button type="submit" class="btn btn-outline-success float-lg-right btn-lg">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<div class="card">
    <div class="card-header text-uppercase">Borrow Report</div>
    <div class="card-body">
        <table class="table table-bordered datatable table-hover nowrap table-responsive-lg">
            <thead class="">
                <tr>
                    <th>No.</th>
                    <th>Customer</th>
                    <th>Code</th>
                    {{-- <th>Book</th> --}}
                    <th>Deposite($)</th>
                    <th>Find Amount</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Action</th>
                    {{-- <th style="display: none;"></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($borrows as $borrow)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ @$borrow->customer->name }}</td>
                    <td>{{ $borrow->borrow_code }}</td>
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
                    <td>$ {{ $borrow->deposit_amount }}</td>
                    <td>$ {{ $borrow->find_amount }}</td>
                    <td>{{ $borrow->borrow_date }}</td>
                    <td>{{ $borrow->due_date }}</td>
                    <td>{{ $borrow->return_date }}</td>
                    <td>
                        <a href="#" class="btn btn-outline-success text-uppercase" data-toggle="modal" data-target="#show-{{ $borrow->id }}" data-toggle="tooltip" title="@lang('Show')">View</a>&nbsp;&nbsp;
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
