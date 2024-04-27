@extends('backends.master')
@section('title', 'Show Is Return')
@section('contents')
<div class="back-btn">
    <a href="{{ route('is_return.index') }}" class="float-left" data-value="veiw">
        <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
        Back to all Return List
    </a><br>
</div><br>
<div class="card">
    <div class="card-header text-uppercase">Borrow Detail</div>
    <div class="card-body">
        <div class="col-sm-12">
            <div class="row">
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Borrowo Code')</label>
                    <p>{{ $borrow->borrow_code }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Customer Name')</label>
                    <p>{{ $borrow->customer->name }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Book')</label>
                    <p>{{ @$borrow->catelog->cate_name }}
                        @foreach ($borrow->book_id as $bookId)
                        @php
                        $book = \App\Models\Book::find($bookId);
                        @endphp
                        @if ($book)
                        <li>
                            {{ $book->book_code }}
                        </li>
                        @endif
                        @endforeach
                    </p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Deposite Amount')</label>
                    <p>$ {{ $borrow->deposit_amount }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Find Amount')</label>
                    <p>$ {{ $borrow->find_amount }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Borrow Date')</label>
                    <p>{{ $borrow->borrow_date }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Due Date')</label>
                    <p>{{ $borrow->due_date }}</p>
                </div>
                @if ($borrow->return_date)
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Return Date')</label>
                    <p>{{ $borrow->return_date }}</p>
                </div>
                @endif
                @if ($borrow->note)
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Note')</label>
                    <p>{{ $borrow->note }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
