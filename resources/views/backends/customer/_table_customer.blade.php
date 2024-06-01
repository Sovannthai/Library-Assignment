<div class="card-body table-wrap">
    <table id="" class="table table-bordered table-hover">
        <thead class="">
            <tr>
                <th>No.</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->code }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->sex }}</td>
                <td>{{ @$customer->customer_type->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->dob }}</td>
                <td>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input toggle-status" id="customSwitches{{ $customer->id }}" data-id="{{ $customer->id }}" {{ $customer->status =='1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitches{{ $customer->id }}"></label>
                    </div>
                </td>
                <td class="text-uppercase">
                    <a href="" class="btn btn-outline-primary btn-sm btn-md" data-toggle="modal" data-target="#show-{{ $customer->id }}" data-toggle="tooltip" title="@lang('Show')"><i class="fa fa-eye ambitious-padding-btn"> View</i></a>&nbsp;&nbsp;
                    @include('backends.customer.show')
                    @if (auth()->user()->can('edit.customer'))
                    <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}" class="btn btn-outline-success btn-sm btn-md" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"> Edit</i></a>&nbsp;&nbsp;
                    @endif
                    @if (auth()->user()->can('delete.customer'))
                    <form id="deleteForm" action="{{ route('customer.destroy', ['customer' => $customer->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger btn-sm btn-md delete-btn text-uppercase" title="@lang('Delete')">
                            <i class="fa fa-trash-can ambitious-padding-btn"> Delete</i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 d-flex flex-row flex-wrap">
        <div class="col-12 col-sm-6 text-center text-sm-left" style="margin-block: 20px">
            {{ __('Showing') }} {{ $customers->firstItem() }} {{ __('to') }} {{ $customers->lastItem() }}
            {{ __('of') }} {{ $customers->total() }} {{ __('entries') }}
        </div>
        <div class="col-12 col-sm-6"> {{ $customers->appends(request()->input())->links() }}</div>
    </div>
</div>
