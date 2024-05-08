@extends('backends.master')
@section('title', 'Role')
@section('contents')
    <div class="card">
        <div class="card-header text-uppercase">
            List Role
            @if (auth()->user()->can('create.role'))
                <a href="{{ route('add_role') }}" class="btn btn-success btn-sm float-lg-right"><i class="fa-solid fa-plus">
                        Add New</i></a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-striped datatable nowrap table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td class="table-plus">{{ $role->name }}</td>
                            <td>
                                @if ($role->name != 'Admin')
                                    @if (auth()->user()->can('edit.role'))
                                        <a href="{{ route('edit_role', ['id' => $role->id]) }}"
                                            class="btn btn-success btn-sm btn-style"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                    @endif
                                    @if (auth()->user()->can('delete.role'))
                                        <form id="deleteForm" action="{{ route('destroy_role', ['id' => $role->id]) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn btn-danger btn-outline btn-circle btn-sm btn-md delete-btn btn-style"
                                                title="@lang('Delete')">
                                                <i class="fa fa-trash ambitious-padding-btn"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <h4>No data</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
