@extends('backends.master')
@section('title', 'Book Report')
@section('contents')
    <div class="card">
        <h5 class="card-header">
            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example"
                id="heading-example" class="d-block">
                <i class="fa fa-filter"></i>
                @lang('Filter')
            </a>
        </h5>
        <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="cate_id">@lang('Catelog')</label>
                        <select id="catelog-filter" class="form-control">
                            <option value="" {{ !request()->filled('cate_id') ? 'selected' : '' }}>@lang('All')
                            </option>
                            @foreach ($catelogs as $catelog)
                                <option value="{{ $catelog->id }}"
                                    {{ request('cate_id') == $catelog->id ? 'selected' : '' }}>
                                    {{ $catelog->cate_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="created_by">@lang('Created By')</label>
                        <select id="created_by-filter" class="form-control custom-select rounded-0"
                            id="exampleSelectRounded0">
                            <option value="" {{ !request()->filled('created_by') ? 'selected' : '' }}>
                                @lang('All')
                            </option>
                            @foreach ($librarains as $librarain)
                                <option value="{{ $librarain->id }}"
                                    {{ request('created_by') == $librarain->id ? 'selected' : '' }}>
                                    {{ $librarain->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">@lang('Book Report')</div>
        <div class="card-body">
            <table class="table table-bordered datatable table-hover">
                <thead class="">
                    <tr>
                        <th>@lang('Code')</th>
                        <th>@lang('Catelog')</th>
                        <th>@lang('Customer')</th>
                        <th>@lang('Borrow Date')</th>
                        <th>@lang('Return Date')</th>
                        <th>@lang('Created at')</th>
                        {{-- <th>@lang('Created By')</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book_borrows as $book_borrow)
                        <tr>
                            <td>{{ @$book_borrow->book->book_code }}</td>
                            <td>{{ @$book_borrow->book->catelog->cate_name }}</td>
                            <td>{{ @$book_borrow->customer->name }}</td>
                            <td>{{ $book_borrow->borrow->borrow_date }}</td>
                            <td>
                                @if ($book_borrow->borrow->return_date)
                                    {{ $book_borrow->borrow->return_date }}
                                @else
                                    @lang('Not Return')
                                @endif
                            </td>
                            <td>{{ $book_borrow->created_at->format('Y/m/d h:i A') }}</td>
                            {{-- <td>{{ @$book_borrow->borrow->created_by->name }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('js')
        <script>
            function applyFilters() {
                var cate_id = document.getElementById('catelog-filter').value;
                var created_by = document.getElementById('created_by-filter').value;
                var url = "{{ route('book_report.index') }}";
                if (cate_id !== '') {
                    url += "?cate_id=" + cate_id;
                }
                if (created_by !== '') {
                    url += (url.includes('?') ? '&' : '?') + "created_by=" + created_by;
                }
                window.location.href = url;
            }
            document.getElementById('catelog-filter').addEventListener('change', applyFilters);
            document.getElementById('created_by-filter').addEventListener('change', applyFilters);
        </script>
    @endpush
@endsection
