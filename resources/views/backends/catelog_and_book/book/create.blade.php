@extends('backends.master')
@section('title','Create Book')
@section('contents')
<div class="back-btn">
    <a href="{{ route('book.index') }}" class="float-left" data-value="veiw">
        <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
        @lang('Back to all')
    </a><br>
</div><br>
<div class="card">
    <div class="card-header text-uppercase">@lang('Create')</div>
    <div class="card-body">
        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <label for="">@lang('Book Code')</label>
                    <input type="text" class="form-control" name="book_code">
                    @error('book_code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="">@lang('Catelog')</label>
                    <select class="form-control ambitious-form-loading select2" name="cate_id" id="cate_id" placeholder="Select catelog">
                        <option value="{{ old('catelog') }}" disabled selected>@lang('Select Catelog')</option>
                        @foreach ($catelogs as $catelog)
                        @if (old('catelog') == $catelog->id)
                        <option value="{{ $catelog->id }}" selected>
                            {{ $catelog->cate_name }}</option>
                        @else
                        <option value="{{ $catelog->id }}">
                            {{ $catelog->cate_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('cate_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-12   ">
                    <label for="">@lang('Description')</label>
                    <textarea name="description" rows="4" class="form-control"></textarea>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success float-sm-right ml-1">@lang('Save')</button>
                <a href="{{ route('book.index') }}" class="btn btn-secondary float-sm-right" >@lang('Close')</a>
            </div>
        </form>
    </div>
</div>
@push('js')

@endpush
@endsection
