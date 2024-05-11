<div class="card-body">
    <table id="" class="table table-bordered datatable table-striped table-hover nowrap table-responsive">
        <thead class="">
            <tr>
                <th>Customer Name</th>
                <th>Borrow Code</th>
                <th>Book Name</th>
                <th>Deposite Amount</th>
                <th>Find Amount</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $borrow)
            <tr>
                <td>{{ $borrow->customer->name }}</td>
                <td>{{ $borrow->borrow_code }}</td>
                <td>
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
                <td>{{ $borrow->due_date }}</td>
                <td>
                    @if (auth()->user()->can('view.borrow'))
                    <a href="" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="modal" data-target="#show-{{ $borrow->id }}" data-toggle="tooltip" title="@lang('Show')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                    @include('backends.borrow.show')
                    @endif
                    @if (auth()->user()->can('edit.borrow'))
                    <a href="{{ route('borrow.edit', ['borrow' => $borrow->id]) }}" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
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