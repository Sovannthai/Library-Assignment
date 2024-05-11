@extends('backends.master')
@section('title', 'Borrow')
@section('contents')
<div class="card">
    <h6 class="card-header">
        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example" id="heading-example" class="d-block">
            <i class="fa fa-filter"></i>
            Filter
        </a>
    </h6>
    <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label for="customer_id">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control select2">
                        <option value="">{{ __('Select Student') }}</option>
                        @foreach ($customers as $row)
                        <option value="{{ $row->id }}" {{ $row->id == request('customer_id') ? 'selected' : '' }}>
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
    <div class="card-header text-uppercase">Return List
        @if (auth()->user()->can('create.borrow'))
        <a href="{{ route('borrow.create') }}" class="btn btn-success float-lg-right">+ Add New</a>
        @endif
    </div>
    @include('backends.borrow._table_is_return')
</div>
@push('js')
<script>
    $(document).ready(function() {
        $(document).on('change', '#customer_id, #book_id', function(e) {
            e.preventDefault();
            var customer_id = $('#customer_id').val(); // Get the selected customer ID
            var book_ids = $('#book_id').val(); // Get the selected book IDs as an array

            // Ensure book_ids is an array
            if (!Array.isArray(book_ids)) {
                book_ids = [book_ids];
            }

            $.ajax({
                type: "GET"
                , url: '{{ route('is_return.index') }}'
                , data: {
                    'customer_id': customer_id
                    , 'book_ids': book_ids
                }
                , dataType: "json"
                , success: function(response) {
                    console.log(response);
                    if (response.view) {
                        $('.datatable').html(response.view);
                    }
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $('#customer_id').select2();
        $('#book_id').select2();
    });

</script>
@endpush
@endsection
