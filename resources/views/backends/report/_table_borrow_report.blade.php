<div class="card-body p-0 table-wrap">
    <table class="table table-bordered table-hover text-nowrap table-responsive-lg">
        <thead class="">
            <tr>
                {{-- <th>@lang('No.')</th> --}}
                <th>@lang('Customer')</th>
                <th>@lang('Book')</th>
                <th>@lang('Code')</th>
                {{-- <th>Book</th> --}}
                <th>@lang('Deposite Amount')($)</th>
                <th>@lang('Find Amount')</th>
                <th>@lang('Borrow Date')</th>
                <th>@lang('Due Date')</th>
                <th>@lang('Return Date')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrow_reports as $borrow_report)
            <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ @$borrow_report->customer->name }}</td>
                <td>{{ $borrow_report->book->book_code }} ({{ $borrow_report->book->catelog->cate_name }})
                </td>
                <td><a href="#" data-toggle="modal" data-target="#show-{{ $borrow_report->id }}">{{ @$borrow_report->borrow->borrow_code }}</a></td>
                {{-- <td>
            @foreach ($borrow->book_id as $bookId)
            @php
            $book = \App\Models\Book::find($bookId);
            @endphp
            @if ($book)
            <li>
                {{ $book->book_code }} ({{ @$book->catelog->cate_name }})
            </li>
            @endif
            @endforeach
        </td> --}}
                <td>$ {{ @$borrow_report->borrow->deposit_amount }}</td>
                <td>$ {{ $borrow_report->find_amount }}</td>
                <td>{{ @$borrow_report->borrow->borrow_date }}</td>
                <td>{{ @$borrow_report->borrow->due_date }}</td>
                <td>
                    @if (@$borrow_report->borrow->return_date)
                        {{ $borrow_report->return_date }}
                    @else
                        <p class="text-secondary">Not Return</p>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-outline-success text-uppercase" data-toggle="modal"
                        data-target="#show-{{ $borrow_report->id }}" data-toggle="tooltip"
                        title="@lang('Show')"> @lang('View')</a>&nbsp;&nbsp;
                    @include('backends.report.show_borrow_report')
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">
                        <p class="text-danger">No Data Found</p>
                    </td>
                </tr>
            @endforelse
            {{-- @foreach ($borrow_reports as $borrow_report)

            @endforeach --}}
        </tbody>
    </table>
    <div class="col-12 d-flex flex-row flex-wrap">
        <div class="col-12 col-sm-6 text-center text-sm-left" style="margin-block: 20px">
            {{ __('Showing') }} {{ $borrow_reports->firstItem() }} {{ __('to') }}
            {{ $borrow_reports->lastItem() }} {{ __('of') }} {{ $borrow_reports->total() }}
            {{ __('entries') }}
        </div>
        <div class="col-12 col-sm-6"> {{ $borrow_reports->appends(request()->input())->links() }}</div>
    </div>
</div>
