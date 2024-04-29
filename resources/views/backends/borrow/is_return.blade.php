@extends('backends.master')
@section('title', 'Borrow')
@section('contents')
<div class="card">
    <h6 class="card-header">
        <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example" id="heading-example" class="d-block">
            <i class="fa fa-filter"></i>
            Filter
        </a>
    </h6>
    <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label for="customer_id">Customer</label>
                    <select id="customer-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                        <option value="" {{ !request()->filled('customer_id') ? 'selected' : '' }}>All Customer
                        </option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="catelog_id">Catelog</label>
                    <select id="catelog-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                        <option value="" {{ !request()->filled('catelog_id') ? 'selected' : '' }}>All Book
                        </option>
                        @foreach ($catelogs as $catelog)
                        <option value="{{ $catelog->id }}" {{ request('catelog_id') == $catelog->id ? 'selected' : '' }}>
                            {{ $catelog->cate_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="col-sm-4">
                        <label for="cate_id">Book</label>
                        <select id="catelog-filter" class="form-control">
                            <option value="" {{ !request()->filled('cate_id') ? 'selected' : '' }}>All Book
                </option>
                @foreach ($catelogs as $catelog)
                <option value="{{ $catelog->id }}" {{ request('cate_id') == $catelog->id ? 'selected' : '' }}>
                    {{ $catelog->cate_name }}
                </option>
                @endforeach
                </select>
            </div> --}}
        </div>
    </div>
</div>
</div>
<div class="card">
    <div class="card-header text-uppercase">Return List
        @if (auth()->user()->can('create.borrow'))
        <a href="{{ route('borrow.create') }}" class="btn btn-success float-lg-right">+ Add New</a>
        @endif
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover nowrap table-responsive-lg">
            <thead class="">
                <tr>
                    <th>Customer Name</th>
                    <th>Borrow Code</th>
                    <th>Book Name</th>
                    {{-- <th>Deposite Amount</th>
                    <th>Find Amount</th> --}}
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Action</th>
                    {{-- <th style="display: none;"></th> --}}
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
                            {{ $book->book_code }}
                        </li>
                        @endif
                        @endforeach
                    </td>
                    {{-- <td>$ {{ $borrow->deposit_amount }}</td>
                    <td>$ {{ $borrow->find_amount }}</td> --}}
                    <td>{{ $borrow->borrow_date }}</td>
                    <td>{{ $borrow->return_date }}</td>
                    <td>
                        @if (auth()->user()->can('view.borrow'))
                        <a href="{{ route('is_return.show',['id'=>$borrow->id]) }}" class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="tooltip" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
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
        </table>
    </div>
</div>
<script>
    function applyFilters() {
        var customer_id = document.getElementById('customer-filter').value;
        var catelog_id = document.getElementById('catelog-filter').value;
        // var book_id = document.getElementById('book-filter').value;
        var url = "{{ route('is_return.index') }}";
        if (customer_id !== '') {
            url += "?customer_id=" + customer_id;
        }
        if (catelog_id !== '') {
            url += (url.includes('?') ? '&' : '?') + "catelog_id=" + catelog_id;
        }
        // if (book_id !== '') {
        //     url += (url.includes('?') ? '&' : '?') + "book_id=" + book_id;
        // }
        window.location.href = url;
    }
    document.getElementById('customer-filter').addEventListener('change', applyFilters);
    document.getElementById('catelog-filter').addEventListener('change', applyFilters);
    // document.getElementById('book-filter').addEventListener('change', applyFilters);
</script>
@endsection
