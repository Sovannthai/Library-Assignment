<div class="card-body">
    <table class="table table-bordered datatable table-striped table-hover nowrap table-responsive">
        <thead class="">
            <tr>
                <th>Customer Name</th>
                <th>Borrow Code</th>
                <th>Book Name</th>
                <th>Deposite Amount</th>
                <th>Find Amount</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $borrow)
            <tr>
                <td>{{ $borrow->customer->name }}</td>
                <td>{{ $borrow->borrow_code }}</td>
                <td>{{ @$borrow->catelog->cate_name }}
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
                </td>
                <td>$ {{ $borrow->deposit_amount }}</td>
                <td>$ {{ $borrow->find_amount }}</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->return_date }}</td>
                <td>
                    @if (auth()->user()->can('view.borrow'))
                    <a href="" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="modal" data-target="#is_show-{{ $borrow->id }}" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                    @include('backends.borrow.show_is_return')
                    @endif
                    @if (auth()->user()->can('delete.borrow'))
                    <form id="deleteForm" action="{{ route('borrow.destroy', ['borrow' => $borrow->id]) }}" method="POST" class="d-inline-block">
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
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-size: 18px;" class="font-bold">Total Deposit: $ {{ number_format($total_deposite,2) }}</td>
                <td style="font-size: 18px;" class="font-bold">Total Find Amount: $ {{ number_format($total_find_amount, 2) }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
