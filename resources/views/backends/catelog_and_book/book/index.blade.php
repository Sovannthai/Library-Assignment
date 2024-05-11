@extends('backends.master')
@section('title','Book')
@section('contents')
<div class="card">
    <h6 class="card-header">
        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
            id="heading-example" class="d-block">
            <i class="fa fa-filter"></i>
            Filter
        </a>
    </h6>
    <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label for="cate_id">Catelog</label>
                    <select name="cate_id" id="cate_id" class="form-control select2">
                        <option value="">{{ __('Select Student') }}</option>
                        @foreach ($catelogs as $row)
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
    <div class="card-header text-uppercase">List Book
        @if (auth()->user()->can('create.book'))
        <a href="{{ route('book.create') }}" class="btn btn-success float-lg-right">+ Add New</a>
        @endif
    </div>
    @include('backends.catelog_and_book.book._table_book')
</div>
@push('js')
<script>
    $(document).ready(function() {
        $(document).on('change', '#cate_id, #book_id', function(e) {
            e.preventDefault();
            var cate_id = $('#cate_id').val();
            var book_ids = $('#book_id').val();
            if (!Array.isArray(book_ids)) {
                book_ids = [book_ids];
            }

            $.ajax({
                type: "GET"
                , url: '{{ route('book.index') }}'
                , data: {
                    'cate_id': cate_id
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
        $('#cate_id').select2();
        $('#book_id').select2();
    });

</script>
<script>
    $('.toggle-status').on('change', function() {
    var status = $(this).prop('checked') ? 'true' : 'false';
    $.ajax({
        type: "POST",
        url: "{{ route('book.update_status') }}",
        data: {
            "id": $(this).data('id'),
            "status": status
        },
        dataType: "json",
        success: function(response) {
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
