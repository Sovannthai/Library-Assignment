@extends('backends.master')
@section('title', 'Customer')
@push('css')
@endpush
@section('contents')
<div class="card">
    <h6 class="card-header">
        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example" id="heading-example" class="d-block">
            <i class="fa fa-filter"></i>
            @lang('Filter')
        </a>
    </h6>
    <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label for="customer_type_id">@lang('Type')</label>
                    <select name="customer_type_id" id="customer_type_id" class="form-control select2">
                        <option value="">{{ __('All') }}</option>
                        @foreach ($customer_types as $row)
                        <option value="{{ $row->id }}" {{ $row->id == request('customer_type_id') ? 'selected' : '' }}>
                            {{ $row->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header text-uppercase">@lang('List customer')
        @if (auth()->user()->can('create.customer'))
        <a href="{{ route('customer.create') }}" class="btn btn-success float-lg-right">+ @lang('Add')</a>
        @endif
    </div>
    @include('backends.customer._table_customer')
</div>
@push('js')
<script>
    $(document).ready(function() {
        $(document).on('change', '#customer_type_id, #book_id', function(e) {
            e.preventDefault();
            var customer_type_id = $('#customer_type_id').val();
            var book_ids = $('#book_id').val();
            if (!Array.isArray(book_ids)) {
                book_ids = [book_ids];
            }

            $.ajax({
                type: "GET"
                , url: '{{ route('customer.index') }}'
                , data: {
                    'customer_type_id': customer_type_id
                    , 'book_ids': book_ids
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
        $('#customer_type_id').select2();
        $('#book_id').select2();
    });

</script>
<script>
    $('.toggle-status').on('change', function() {
        var status = $(this).prop('checked') ? 'true' : 'false';
        $.ajax({
            type: "POST"
            , url: "{{ route('customer.status_update') }}"
            , data: {
                "id": $(this).data('id')
                , "status": status
            }
            , dataType: "json"
            , success: function(response) {
                if (response.success == 1) {
                    toastr.success(response.msg);
                } else {
                    toastr.error(response.msg);
                }
            }
        });
    });

</script>
@endpush
@endsection
