<div class="modal fade" id="show-{{ $borrow_report->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLabel">@lang('Borrow Detail')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Borrow Code')</label>
                            <p>{{ @$borrow_report->borrow->borrow_code }}</p>
                        </div>
                        <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Customer')</label>
                            <p>{{ @$borrow_report->customer->name }}</p>
                        </div>
                        {{-- <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Book')</label>
                            <p>{{ @$borrow->catelog->cate_name }}
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
                            </p>
                        </div> --}}
                        <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Book')</label>
                            <p>{{ @$borrow_report->book->book_code }} {{ @$borrow_report->book->catelog->cate_name }}</p>
                        </div>
                        <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Deposite Amount')</label>
                            <p>$ {{ @$borrow_report->borrow->deposit_amount }}</p>
                        </div>
                        <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Find Amount')</label>
                            <p>$ {{ $borrow_report->find_amount }}</p>
                        </div>
                        <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Borrow Date')</label>
                            <p>{{ @$borrow_report->borrow->borrow_date }}</p>
                        </div>
                        <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                            <label class="font-weight-bold mb-1 text-uppercase">@lang('Due Date')</label>
                            <p>{{ @$borrow_report->borrow->due_date }}</p>
                        </div>
                        @if ($borrow_report->return_date)
                            <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                                <label class="font-weight-bold mb-1 text-uppercase">@lang('Return Date')</label>
                                <p>{{ $borrow_report->return_date }}</p>
                            </div>
                        @endif
                        @if ($borrow_report->note)
                            <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                                <label class="font-weight-bold mb-1 text-uppercase">@lang('Note')</label>
                                <p>{{ $borrow_report->note }}</p>
                            </div>
                        @endif
                        @if (@$borrow_report->createdBy->name)
                            <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                                <label class="font-weight-bold mb-1 text-uppercase">@lang('Created By')</label>
                                <p>{{ @$borrow_report->createdBy->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
