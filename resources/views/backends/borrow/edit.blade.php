@extends('backends.master')
@section('title', 'Edit Borrow')
@section('contents')
    <div class="back-btn">
        <a href="{{ route('borrow.index') }}" class="float-left" data-value="veiw">
            <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
            @lang('Back to all')
        </a><br>
    </div><br>
    <div class="card">
        <div class="card-header text-uppercase bg-success">@lang('Edit')</div>
        <div class="card-body">
            <form action="{{ route('borrow.update', ['borrow' => $borrow->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4">
                        <label for="">@lang('Customer')</label>
                        <select class="form-control ambitious-form-loading select2" name="customer_id" id="customer_id">
                            <option value="{{ old('customer') }}" disabled selected>@lang('Select')</option>
                            @foreach ($customers as $customer)
                                @if (old('customer') == $customer->id)
                                    <option value="{{ $customer->id }}"
                                        {{ $customer->id == $borrow->customer_id ? 'selected' : '' }} selected>
                                        {{ $customer->name }}</option>
                                @else
                                    <option value="{{ $customer->id }}"
                                        {{ $customer->id == $borrow->customer_id ? 'selected' : '' }}>
                                        {{ $customer->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-sm-4">
                        <label for="">@lang('Book')</label>
                        <select multiple class="form-control ambitious-form-loading select2" name="book_id[]"
                            id="book_id">
                            @foreach ($books as $book)
                                @php
                                    $selected =
                                        $borrow->book_id && in_array($book->id, $borrow->book_id) ? 'selected' : '';
                                @endphp
                                <option value="{{ $book->id }}" {{ $selected }}>
                                    {{ $book->book_code }} ({{ $book->catelog->cate_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-sm-4">
                        <label for="">@lang('Book')</label>
                        <select multiple class="form-control ambitious-form-loading select2" name="book_id[]" id="book_id">
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" {{ in_array($book->id, $book_ids) ?'selected':'' }}>
                                    {{ $book->book_code }} ({{ $book->catelog->cate_name }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Deposite Amount')</label>
                        <input type="number" class="form-control" name="deposit_amount"
                            value="{{ $borrow->deposit_amount }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Borrow Date')</label>
                        <input type="date" class="form-control" name="borrow_date" value="{{ $borrow->borrow_date }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Due Date')</label>
                        <input type="date" class="form-control" name="due_date" value="{{ $borrow->due_date }}">
                    </div>
                    <div class="col-sm-12   ">
                        <label for="">@lang('Note')</label>
                        <textarea name="note" rows="4" class="form-control">{{ $borrow->note }}</textarea>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-success float-sm-right ml-1">@lang('Save')</button>
                    <a href="{{ route('borrow.index') }}" class="btn btn-secondary float-sm-right">@lang('Close')</a>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        {{-- <script>
    $(document).ready(function() {
        $('#cate_id').change(function() {
            var cate_id = $(this).val();
            if (cate_id) {
                $.ajax({
                    url: '/fetch-books/' + cate_id
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        $('#book_id').empty();
                        $.each(data, function(key, value) {
                            $('#book_id').append('<option value="' + key + '">' +
                                value + '</option>');
                        });
                        $('#book_id').prop('disabled', false);
                        var bookIdsString = $('#book_id').data('book-ids');
                        var editedBookIds = JSON.parse(bookIdsString);
                        if (Array.isArray(editedBookIds)) {
                            editedBookIds.forEach(function(id) {
                                $('#book_id option[value="' + id + '"]').prop(
                                    'selected', true);
                            });
                        }
                    }
                });
            } else {
                $('#book_id').empty();
                $('#book_id').prop('enable', true);
            }
        });
    });
</script> --}}
    @endpush
@endsection
