<div class="card-body p-0 table-wrap">
    <table id="" class="table table-bordered table-hover text-nowrap table-responsive">
        <thead class="text-center">
            <tr>
                <th>No.</th>
                <th>Customer Name</th>
                <th>Borrow Code</th>
                {{-- <th>Book Name</th> --}}
                <th>Deposite Amount</th>
                {{-- <th>Find Amount</th> --}}
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $borrow)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $borrow->customer->name }}</td>
                <td>{{ $borrow->borrow_code }}</td>
                {{-- <td>
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
                <td>$ {{ $borrow->deposit_amount }}</td>
                {{-- <td>$ {{ $borrow->find_amount }}</td> --}}
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->due_date }}</td>
                <td>
                    @if ($borrow->note)
                    {{ Str::limit($borrow->note,) }}
                    @elseif(!$borrow->note)
                        <span class="text-secondary">No data</span>
                    @endif
                </td>
                <td class="text-uppercase">
                    <a href="" class="btn btn-outline-info btn-sm btn-md" data-toggle="modal" data-target="#return-{{ $borrow->id }}" data-toggle="tooltip" title="@lang('Return')"><li class="nav-icon fas fa-exchange-alt"> Return</li></a>
                    @include('backends.borrow.return_book')
                    @if (auth()->user()->can('view.borrow'))
                    <a href="" class="btn btn-outline-primary btn-outline btn-sm btn-md ml-2" data-toggle="modal" data-target="#show-{{ $borrow->id }}" data-toggle="tooltip" title="@lang('Show')"><i class="fa fa-eye ambitious-padding-btn"> View</i></a>&nbsp;&nbsp;
                    @include('backends.borrow.show')
                    @endif
                    @if (auth()->user()->can('edit.borrow'))
                    <a href="{{ route('borrow.edit', ['borrow' => $borrow->id]) }}" class="btn btn-outline-success btn-outline btn-sm btn-md" data-toggle="tooltip" title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"> Edit</i></a>&nbsp;&nbsp;
                    @endif
                    @if (auth()->user()->can('delete.borrow'))
                    <form id="deleteForm" action="{{ route('borrow.destroy', ['borrow' => $borrow->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger btn-outline btn-sm btn-md delete-btn text-uppercase" title="@lang('Delete')">
                            <i class="fa fa-trash-can ambitious-padding-btn"> Delete</i>
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
        <td style="font-size: 18px;" class="font-bold"><strong>Total Deposit: $ {{ number_format($total_deposite,2) }}</strong></td>
        <td></td>
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
