<div class="modal fade" id="return-{{ $borrow->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Return Book')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('return.input', ['id' => $borrow->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        {{-- <div class="col-sm-4">
                            <label for="">@lang('Book')</label>
                            <select multiple="multiple" class="form-control ambitious-form-loading select2 book_id"
                                name="book_id[]" id="book_id">
                                @foreach ($borrow->borrow_detail as $book)
                                    @if (old('book_id') == $book->id)
                                        <option value="{{ $book->id }}" selected>
                                            {{ $book->book->book_code }} ({{ $book->book->catelog->cate_name }})
                                        </option>
                                    @else
                                        <option value="{{ $book->id }}">
                                            {{ $book->book->book_code }} ({{ $book->book->catelog->cate_name }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('book_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="col-sm-6">
                            <label for="">@lang('Return Date')</label>
                            <input type="date" name="return_date" class="form-control"
                                value="{{ $borrow->return_date }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="">@lang('Find Amount')</label>
                            <input type="number" name="find_amount" class="form-control"
                                value="{{ $borrow->return_date }}" placeholder="@lang('Enter amount')">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary btn-sm float-lg-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
