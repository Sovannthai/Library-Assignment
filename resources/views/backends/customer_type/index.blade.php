@extends('backends.master')
@section('title','Book')
@section('contents')
    <div class="card">
        <div class="card-header text-uppercase">List Type
            <a href="" class="btn btn-success float-lg-right" data-toggle="modal" data-target="#create">+ Add New</a>
            @include('backends.customer_type.create')
        </div>
        <div class="card-body">
            <table class="table datatable table-bordered table-striped table-hover">
                <thead class="">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer_types as $customer_type)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer_type->name }}</td>
                        <td>
                            <a href="" class="btn btn-outline-success text-uppercase btn-sm btn-md" data-toggle="modal" data-target="#edit-{{ $customer_type->id }}" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"> Edit</i></a>&nbsp;&nbsp;
                            @include('backends.customer_type.edit')
                            <form id="deleteForm" action="{{ route('customer_type.destroy',['customer_type'=>$customer_type->id]) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-outline-danger btn-sm btn-md delete-btn text-uppercase" title="@lang('Delete')">
                                    <i class="fa fa-trash-can ambitious-padding-btn"> Delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@push('js')
@endpush
@endsection
