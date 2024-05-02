@extends('backends.master')
@section('title', 'Customer Report')
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
                    <label for="created_by">Created By</label>
                    <select id="created_by-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                        <option value="" {{ !request()->filled('created_by') ? 'selected' : '' }}>All
                        </option>
                        @foreach ($librarains as $librarain)
                        <option value="{{ $librarain->id }}" {{ request('created_by') == $librarain->id ? 'selected' : '' }}>
                            {{ $librarain->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="customer_type_id">Type</label>
                    <select id="type-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                        <option value="" {{ !request()->filled('customer_type_id') ? 'selected' : '' }}>All
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
    <div class="card-header text-uppercase">Customer Report</div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead class="">
                <tr>
                    <th>Customer Name</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Created By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ @$customer->customer_type->name }}</< /td>
                    <td>{{ $customer->created_at->format('Y/m/d h:i A') }}</< /td>
                    <td>{{ @$customer->createdBy->name }}</< /td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('js')
<script>
    function applyFilters() {
        var created_by = document.getElementById('created_by-filter').value;
        var customer_type_id = document.getElementById('type-filter').value;
        var url = "{{ route('customer_report.index') }}";
        if (created_by !== '') {
            url += (url.includes('?') ? '&' : '?') + "created_by=" + created_by;
        }
        if (customer_type_id !== '') {
            url += (url.includes('?') ? '&' : '?') + "customer_type_id=" + customer_type_id;
        }
        window.location.href = url;
    }
    document.getElementById('created_by-filter').addEventListener('change', applyFilters);
    document.getElementById('type-filter').addEventListener('change', applyFilters);

</script>
@endpush
@endsection
