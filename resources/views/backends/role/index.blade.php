@extends('backends.master')
@section('title', 'Role')
@section('contents')
    <div class="card">
        <div class="card-header text-uppercase">
            @lang('List Role')
            @if (auth()->user()->can('create.role'))
                <a href="{{ route('add_role') }}" class="btn btn-success btn-sm float-lg-right"><i class="fa-solid fa-plus">
                        @lang('Add')</i></a>
            @endif
        </div>
        <div class="card-body">
            <table class="table datatable nowrap table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@lang('No.')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="table-plus">{{ $role->name }}</td>
                            <td>
                                @if ($role->name != 'Admin')
                                    @if (auth()->user()->can('edit.role'))
                                        <a href="{{ route('edit_role', ['id' => $role->id]) }}"
                                            class="btn btn-outline-success btn-sm text-uppercase"><i
                                                class="fa-regular fa-pen-to-square"> @lang('Edit')</i></a>
                                    @endif
                                    @if (auth()->user()->can('delete.role'))
                                        <form id="deleteForm" action="{{ route('destroy_role', ['id' => $role->id]) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm btn-md delete-btn text-uppercase"
                                                title="@lang('Delete')">
                                                <i class="fa fa-trash ambitious-padding-btn"> @lang('Delete')</i>
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
