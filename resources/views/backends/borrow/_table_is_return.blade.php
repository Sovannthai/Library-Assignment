<div class="card-body p-0 table-wrap table-responsive">
    <table class="table table-bordered table-hover text-nowrap">
        <thead class="">
            <tr>
                <th>@lang('No.')</th>
                <th>@lang('Customer')</th>
                <th>@lang('Borrow Code')</th>
                <th>@lang('Book')</th>
                <th>@lang('Deposite Amount')</th>
                <th>@lang('Find Amount')</th>
                <th>@lang('Borrow Date')</th>
                <th>@lang('Return Date')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $borrow)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $borrow->customer->name }}</td>
                <td>{{ $borrow->borrow_code }}</td>
                {{-- <td>{{ @$borrow->catelog->cate_name }}
                    @foreach ($borrow->book_id as $bookId)
                    @php
                    $book = \App\Models\Book::find($bookId);
                    @endphp
                    @if ($book)
                    <li>
                        {{ $book->book_code }} ({{ $book->catelog->cate_name }})
                    </li>
                    @endif
                    @endforeach
                </td> --}}
                <td>
                    @foreach ($borrow->borrow_detail as $borrow_detail)
                        <li>
                            {{ $borrow_detail->book->book_code }} ({{ $borrow_detail->book->catelog->cate_name }})
                        </li>
                        </li>
                    @endforeach
                </td>
                <td>$ {{ $borrow->deposit_amount }}</td>
                <td>$ {{ $borrow->find_amount }}</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->return_date }}</td>
                <td class="text-uppercase">
                    @if (auth()->user()->can('view.borrow'))
                    <a href="" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#is_show-{{ $borrow->id }}" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"> @lang('View')</i></a>&nbsp;&nbsp;
                    @include('backends.borrow.show_is_return')
                    @endif
                    @if (auth()->user()->can('delete.borrow'))
                    <form id="deleteForm" action="{{ route('borrow.destroy', ['borrow' => $borrow->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn" title="@lang('Delete')">
                            <i class="fa fa-trash-can ambitious-padding-btn"> @lang('Delete')</i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-size: 18px;" class="font-bold"><strong>@lang('Total Deposit') $ {{ number_format($total_deposite,2) }}</strong></td>
        <td style="font-size: 18px;" class="font-bold"><strong>@lang('Total Find Amount'): $ {{ number_format($total_find_amount, 2) }}</strong></td>
        <td></td>
        <td></td>
        <td></td>
    </table>
    <div class="col-12 d-flex flex-row flex-wrap">
        <div class="col-12 col-sm-6 text-center text-sm-left" style="margin-block: 20px">
            {{ __('Showing') }} {{ $borrows->firstItem() }} {{ __('to') }}
            {{ $borrows->lastItem() }} {{ __('of') }} {{ $borrows->total() }}
            {{ __('entries') }}
        </div>
        <div class="col-12 col-sm-6"> {{ $borrows->appends(request()->input())->links() }}</div>
    </div>
</div>
