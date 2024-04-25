@extends('backends.master')
@section('title','Catelog')
@section('contents')
    <div class="card">
        <div class="card-header text-uppercase">List Catelog
            @if (auth()->user()->can('create.catelog'))
            <a href="" class="btn btn-success float-lg-right" data-toggle="modal" data-target="#create">+ Add New</a>
            @include('backends.catelog_and_book.catelog.create')
            @endif
        </div>
        <div class="card-body">
            <table class="table datatable table-bordered table-striped table-hover">
                <thead class="text-uppercase">
                    <tr>
                        <th>Cover</th>
                        <th>code</th>
                        <th>Name</th>
                        <th>isbn</th>
                        <th>Author Name</th>
                        <th>Publisher</th>
                        <th>Publish Year</th>
                        <th>Pubish Edition</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catelogs as $catelog)
                    <tr>
                        <td>
                            <span>
                                <a class="example-image-link" href="{{ url('uploads/all_photo/'.$catelog->photo) }}" data-lightbox="lightbox-' . $catelog->id . '">
                                    <img class="example-image image-thumbnail" src="{{ url('uploads/all_photo/'.$catelog->photo) }}" alt="profile" width="90px" height="50px" style="cursor:pointer" />
                                </a>
                            </span>
                        </td>
                        <td>{{ $catelog->cate_code }}</td>
                        <td>{{ $catelog->cate_name }}</td>
                        <td>{{ $catelog->isbn }}</td>
                        <td>{{ $catelog->author_name }}</td>
                        <td>{{ $catelog->publisher }}</td>
                        <td>{{ $catelog->publishyear }}</td>
                        <td>{{ $catelog->publish_edition }}</td>
                        <td>
                            @if (auth()->user()->can('edit.catelog'))
                            <a href="" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="modal" data-target="#edit-{{ $catelog->id }}" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                            @include('backends.catelog_and_book.catelog.edit')
                            @endif
                            @if (auth()->user()->can('delete.catelog'))
                            <form id="deleteForm" action="{{ route('catelog.destroy',['catelog'=>$catelog->id]) }}" method="POST" class="d-inline-block">
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

@endpush
@endsection
