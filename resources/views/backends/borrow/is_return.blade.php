@extends('backends.master')
@section('title', 'Borrow')
@section('contents')
    <div class="card">
        <h6 class="card-header bg-success-header">
            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
                id="heading-example" class="d-block bg-success-header">
                <i class="fa fa-filter"></i>
                @lang('Filter')
            </a>
        </h6>
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
                        <label for="cate_id">@lang('Catelog')</label>
                        <select name="cate_id" id="cate_id" class="form-control select2">
                            <option value="">{{ __('All') }}</option>
                            @foreach ($catalogs as $row)
                                <option value="{{ $row->id }}" {{ $row->id == request('cate_id') ? 'selected' : '' }}>
                                    {{ $row->cate_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">@lang('Return List')
            @if (auth()->user()->can('create.borrow'))
                <a href="{{ route('borrow.create') }}" class="btn btn-success float-lg-right mt-2">+ @lang('Add Borrow')</a>
            @endif
            <div class="search-row mt-2 mb-2 col-sm-4 float-lg-right">
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class=" form-control search-box" autocomplete="off" placeholder="@lang('Search...')">
            </div>
        </div>
        @include('backends.borrow._table_is_return')
    </div>
    @push('js')
    <script>
        $(document).ready(function() {
            $(document).on('keyup', '.search-box', function(e) {
                var search = $(this).val();
                var customer_id = $('#customer_id').val();
                var book_ids = $('#book_id').val();
                $.ajax({
                    type: "get"
                    , url: window.location.href
                    , data: {
                        'search': search
                    , }
                    , dataType: "json"
                    , success: function(response) {
                        console.log(response);
                        if (response.view) {
                            $('.table-wrap').replaceWith(response.view);
                        }
                    }
                });

            })
            $(document).on('change', '#customer_id, #cate_id', function(e) {
                e.preventDefault();
                var customer_id = $('#customer_id').val();
                var cate_id = $('#cate_id').val();
                $.ajax({
                    type: "GET"
                    , url: '{{ route('is_return.index') }}'
                    , data: {
                        'customer_id': customer_id
                        , 'cate_id': cate_id
                    }
                    , dataType: "json"
                    , success: function(response) {
                        console.log(response);
                        if (response.view) {
                            $('.table-wrap').replaceWith(response.view);
                        }
                    }
                    , error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            $('#customer_id').select2();
            $('#cate_id').select2();
        });
    </script>
    @endpush
@endsection
