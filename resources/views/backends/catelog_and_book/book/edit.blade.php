@extends('backends.master')
@section('title','Create Book')
@section('contents')
<div class="card">
    <div class="card-header text-uppercase">Edit Book</div>
    <div class="card-body">
        <form action="{{ route('book.update',['book'=>$book->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-6">
                    <label for="">Book Code</label>
                    <input type="text" class="form-control" name="book_code" value="{{ $book->book_code }}">
                    @error('book_code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="">Catelog</label>
                    <select class="form-control ambitious-form-loading select2" name="cate_id" id="cate_id" placeholder="Select catelog">
                        <option value="{{ old('catelog') }}" disabled selected>Select Catelog</option>
                        @foreach ($catelogs as $catelog)
                        @if (old('catelog') == $catelog->id)
                        <option value="{{ $catelog->id }}" {{ $catelog->id == $book->cate_id ? 'selected':'' }} selected>
                            {{ $catelog->cate_name }}</option>
                        @else
                        <option value="{{ $catelog->id }}" {{ $catelog->id == $book->cate_id ? 'selected':'' }}>
                            {{ $catelog->cate_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('cate_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-12   ">
                    <label for="">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ $book->description }}</textarea>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary float-sm-right ml-1">Save</button>
                <a href="{{ route('book.index') }}" class="btn btn-secondary float-sm-right" >Close</a>
            </div>
        </form>
    </div>
</div>
@push('js')

@endpush
@endsection
