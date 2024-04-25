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
                    <select id="catelog-filter" class="form-control">
                        <option value="" {{ !request()->filled('cate_id') ? 'selected' : '' }}>All Catelog
                        </option>
                        @foreach ($catelogs as $catelog)
                            <option value="{{ $catelog->id }}"
                                {{ request('cate_id') == $catelog->id ? 'selected' : '' }}>
                                {{ $catelog->cate_name }}
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
    <div class="card-body">
        <table class="table datatable table-bordered table-striped table-hover">
            <thead class="">
                <tr>
                    <th>Book Code</th>
                    <th>Catelog Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->book_code }}</td>
                    <td>{{ $book->catelog->cate_name }}</td>
                    <td>{{ $book->description }}</td>
                    <td>
                        @if (auth()->user()->can('edit.book'))
                        <a href="{{ route('book.edit',['book'=>$book->id]) }}" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                        @endif
                        @if (auth()->user()->can('delete.book'))
                        <form id="deleteForm" action="{{ route('book.destroy',['book'=>$book->id]) }}" method="POST" class="d-inline-block">
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
        var cate_id = document.getElementById('catelog-filter').value;
        var url = "{{ route('book.index') }}";
        if (cate_id !== '') {
            url += "?cate_id=" + cate_id;
        }
        window.location.href = url;
    }
    document.getElementById('catelog-filter').addEventListener('change', applyFilters);
</script>
@endpush
@endsection
