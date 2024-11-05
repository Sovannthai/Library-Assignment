@extends('backends.master')
@section('title','Catelog')
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
                    <label for="status">@lang('Status')</label>
                    <select id="status" name="status" class="form-control select2">
                        <option value="" {{ !request()->filled('status') ? 'selected' : '' }}>@lang('All')</option>
                        <option value="1" {{ request('status')=='1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status')=='0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header text-uppercase">@lang('List Catelog')
            @if (auth()->user()->can('create.catelog'))
            <a href="" class="btn btn-success float-lg-right" data-toggle="modal" data-target="#create">+ @lang('Add')</a>
            @include('backends.catelog_and_book.catelog.create')
            @endif
        </div>
        @include('backends.catelog_and_book.catelog._table')
    </div>
@push('js')
<script>
    $(document).ready(function() {
        $(document).on('change', '#cate_id, #status', function(e) {
            e.preventDefault();
            var cate_id = $('#cate_id').val();
            var status = $('#status').val();
            $.ajax({
                type: "GET"
                , url: '{{ route('catelog.index') }}'
                , data: {
                    'cate_id': cate_id
                    , 'status': status
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
        $('#status').select2();
    });

</script>
<script>
    $('.toggle-status').on('change', function() {
    var status = $(this).prop('checked') ? 'true' : 'false';
    $.ajax({
        type: "POST",
        url: "{{ route('catelog.status-update') }}",
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
