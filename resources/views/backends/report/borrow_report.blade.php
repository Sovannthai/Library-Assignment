@extends('backends.master')
@section('title', 'Borrow Report')
@section('contents')
    <div class="card">
        <h5 class="card-header bg-success-header">
            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
                id="heading-example" class="d-block bg-success-header">
                <i class="fa fa-filter"></i>
                @lang('Filter')
            </a>
        </h5>
        <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="customer_id">@lang('Customer')</label>
                        <select name="customer_id" id="customer_id" class="form-control select2">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($customers as $row)
                                <option value="{{ $row->id }}"
                                    {{ $row->id == request('customer_id') ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="cate_id">@lang('Catalog')</label>
                        <select name="cate_id" id="cate_id" class="form-control select2">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($catalogs as $row)
                                <option value="{{ $row->id }}" {{ $row->id == request('cate_id') ? 'selected' : '' }}>
                                    {{ $row->cate_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="created_by">@lang('Created By')</label>
                        <select name="created_by" id="created_by" class="form-control select2">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($Users as $row)
                                <option value="{{ $row->id }}" {{ $row->id == request('created_by') ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <form id="filterForm" method="GET" action="{{ route('report.index') }}">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="start_date">@lang('From Date')</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ old('start_date', request('start_date')) }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="end_date">@lang('To Date')</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ old('end_date', request('end_date')) }}">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-danger btn-lg ml-1"
                            onclick="resetFilter()" style="border-radius: 0">@lang('Reset')</button>
                        <button type="submit" class="btn btn-outline-success btn-lg" style="border-radius: 0">@lang('Filter')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">@lang('Borrow Report')
            <div class="search-row col-sm-4 float-lg-right">
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="form-control search-box" autocomplete="off" placeholder="@lang('Search...')">
            </div>
        </div>
        @include('backends.report._table_borrow_report')
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                function fetchData() {
                    var search = $('#search').val();
                    var customer_id = $('#customer_id').val();
                    var cate_id = $('#cate_id').val();
                    var created_by = $('#created_by').val();

                    $.ajax({
                        type: "GET",
                        url: '{{ route('report.index') }}',
                        data: {
                            'search': search,
                            'customer_id': customer_id,
                            'cate_id': cate_id,
                            'created_by': created_by
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.view) {
                                $('.table-wrap').replaceWith(response.view);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                $(document).on('keyup', '#search', function(e) {
                    fetchData();
                });

                $(document).on('change', '#customer_id, #cate_id, #created_by', function(e) {
                    e.preventDefault();
                    fetchData();
                });

                $('#customer_id').select2();
                $('#cate_id').select2();
                $('#created_by').select2();
            });
        </script>
    @endpush
@endsection
