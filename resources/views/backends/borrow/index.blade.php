@extends('backends.master')
@section('title', 'Borrow')
@section('contents')
    <div class="card">
        <h6 class="card-header">
            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
                id="heading-example" class="d-block">
                <i class="fa fa-filter"></i>
                Filter
            </a>
        </h6>
        <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="customer_id">Customer</label>
                        <select id="customer-filter" class="form-control custom-select rounded-0"
                            id="exampleSelectRounded0">
                            <option value="" {{ !request()->filled('customer_id') ? 'selected' : '' }}>All Customer
                            </option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-sm-4">
                        <label for="catelog_id">Catelog</label>
                        <select id="catelog-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                            <option value="" {{ !request()->filled('catelog_id') ? 'selected' : '' }}>All Book
                            </option>
                            @foreach ($catelogs as $catelog)
                                <option value="{{ $catelog->id }}"
                                    {{ request('catelog_id') == $catelog->id ? 'selected' : '' }}>
                                    {{ $catelog->cate_name }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="col-sm-4">
                    <label for="book_id">book</label>
                    <select id="book-filter" class="form-control custom-select rounded-0" id="exampleSelectRounded0">
                        <option value="" {{ !request()->filled('book_id') ? 'selected' : '' }}>All Book
                </option>
                @foreach ($books as $book)
                <option value="{{ $book->id }}" {{ request('book_id')==$book->id ? 'selected' : '' }}>
                    {{ $book->book_code }}
                </option>
                @endforeach
                </select>
            </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">Borrow List
            @if (auth()->user()->can('create.borrow'))
                <a href="{{ route('borrow.create') }}" class="btn btn-success float-lg-right">+ Add New</a>
            @endif
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover nowrap table-responsive">
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
                                    <a href="{{ route('borrow.show', ['borrow' => $borrow->id]) }}"
                                        class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="tooltip"
                                        title="@lang('Show')"><i
                                            class="fa fa-eye ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endif
                                @if (auth()->user()->can('edit.borrow'))
                                    <a href="{{ route('borrow.edit', ['borrow' => $borrow->id]) }}"
                                        class="btn btn-success btn-outline btn-style btn-sm btn-md" data-toggle="tooltip"
                                        title="@lang('Edit')"><i
                                            class="fa fa-edit ambitious-padding-btn"></i></a>&nbsp;&nbsp;
                                @endif
                                @if (auth()->user()->can('delete.borrow'))
                                    <form id="deleteForm" action="{{ route('borrow.destroy', ['borrow' => $borrow->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-danger btn-outline btn-style btn-sm btn-md delete-btn"
                                            title="@lang('Delete')">
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
            // var catelog_id = document.getElementById('catelog-filter').value;
            // var book_id = document.getElementById('book-filter').value;
            var url = "{{ route('borrow.index') }}";
            if (customer_id !== '') {
                url += "?customer_id=" + customer_id;
            }
            //
            // if (book_id !== '') {
            //     url += (url.includes('?') ? '&' : '?') + "book_id=" + book_id;
            // }
            window.location.href = url;
        }
        document.getElementById('customer-filter').addEventListener('change', applyFilters);
        //document.getElementById('catelog-filter').addEventListener('change', applyFilters);
        // document.getElementById('book-filter').addEventListener('change', applyFilters);
    </script>
@endsection
