<div class="card-body p-0 table-wrap">
    <table id="" class="table table-bordered text-nowrap table-hover">
        <thead class="">
            <tr>
                <th>@lang('No.')</th>
                <th>@lang('Book Code')</th>
                <th>@lang('Catelog')</th>
                <th>@lang('Description')</th>
                <th>@lang('Status')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->book_code }}</td>
                    <td>{{ $book->catelog->cate_name }}</td>
                    <td>{{ $book->description }}</td>
                    <td>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input toggle-status"
                                id="customSwitches{{ $book->id }}" data-id="{{ $book->id }}"
                                {{ $book->status == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitches{{ $book->id }}"></label>
                        </div>
                    </td>
                    <td>
                        @if (auth()->user()->can('edit.book'))
                            <a href="{{ route('book.edit', ['book' => $book->id]) }}"
                                class="btn btn-outline-success btn-sm btn-md text-uppercase" data-toggle="tooltip"
                                title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn">
                                    @lang('Edit')</i></a>&nbsp;&nbsp;
                        @endif
                        @if (auth()->user()->can('delete.book'))
                            <form id="deleteForm" action="{{ route('book.destroy', ['book' => $book->id]) }}"
                                method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="btn btn-outline-danger btn-sm btn-md delete-btn text-uppercase"
                                    title="@lang('Delete')">
                                    <i class="fa fa-trash-can ambitious-padding-btn"> @lang('Delete')</i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        @lang('No Data Found')
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <a href="{{ route('book.create') }}"
                            class="btn btn-outline-success btn-sm btn-md text-uppercase" data-toggle="tooltip"
                            title="@lang('Add')"><i class="fa fa-plus ambitious-padding-btn">
                                @lang('Add')</i></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                </tr>
            @endforelse
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
