<div class="card-body p-0 table-wrap">
    <table id="" class="table table-bordered text-nowrap table-hover">
        <thead class="">
            <tr>
                <th>No.</th>
                <th>Book Code</th>
                <th>Catelog Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $book->book_code }}</td>
                <td>{{ $book->catelog->cate_name }}</td>
                <td>{{ $book->description }}</td>
                <td>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input toggle-status" id="customSwitches{{ $book->id }}" data-id="{{ $book->id }}" {{ $book->status =='1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitches{{ $book->id }}"></label>
                    </div>
                </td>
                <td>
                    @if (auth()->user()->can('edit.book'))
                    <a href="{{ route('book.edit',['book'=>$book->id]) }}" class="btn btn-outline-success btn-sm btn-md text-uppercase" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"> Edit</i></a>&nbsp;&nbsp;
                    @endif
                    @if (auth()->user()->can('delete.book'))
                    <form id="deleteForm" action="{{ route('book.destroy',['book'=>$book->id]) }}" method="POST" class="d-inline-block">
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
            {{ __('Showing') }} {{ $books->firstItem() }} {{ __('to') }}
            {{ $books->lastItem() }} {{ __('of') }} {{ $books->total() }}
            {{ __('entries') }}
        </div>
        <div class="col-12 col-sm-6"> {{ $books->appends(request()->input())->links() }}</div>
    </div>
</div>
