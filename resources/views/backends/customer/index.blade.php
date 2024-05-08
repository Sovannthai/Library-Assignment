@extends('backends.master')
@section('title', 'Customer')
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
                    <label for="customer_type_id">Type</label>
                    <select id="customer_type-filter" class="form-control">
                        <option value="" {{ !request()->filled('customer_type_id') ? 'selected' : '' }}>All Type
                        </option>
                        @foreach ($customer_types as $customer_type)
                        <option value="{{ $customer_type->id }}" {{ request('customer_type_id') == $customer_type->id ? 'selected' : '' }}>
                            {{ $customer_type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header text-uppercase">List customer
        @if (auth()->user()->can('create.customer'))
        <a href="{{ route('customer.create') }}" class="btn btn-success float-lg-right">+ Add New</a>
        @endif
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead class="">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>phone</th>
                    <th>Date of Birth</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->code }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->sex }}</td>
                    <td>{{ $customer->customer_type->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->dob }}</td>
                    <td>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input toggle-status" id="customSwitches{{ $customer->id }}" data-id="{{ $customer->id }}" {{ $customer->status =='1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitches{{ $customer->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="modal" data-target="#show-{{ $customer->id }}" data-toggle="tooltip" title="@lang('Show')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                        @include('backends.customer.show')
                        @if (auth()->user()->can('edit.customer'))
                        <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                        @endif
                        @if (auth()->user()->can('delete.customer'))
                        <form id="deleteForm" action="{{ route('customer.destroy', ['customer' => $customer->id]) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-outline btn-style btn-sm btn-md delete-btn" title="@lang('Delete')">
                                <i class="fa fa-trash-can ambitious-padding-btn"></i>
                            </button>
                        </form>
                        @endif
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
        var customer_type_id = document.getElementById('customer_type-filter').value;
        var url = "{{ route('customer.index') }}";
        if (customer_type_id !== '') {
            url += "?customer_type_id=" + customer_type_id;
        }
        window.location.href = url;
    }
    document.getElementById('customer_type-filter').addEventListener('change', applyFilters);

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
