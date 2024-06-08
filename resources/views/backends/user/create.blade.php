@extends('backends.master')
@section('title', 'Create User')
@section('contents')
<div class="back-btn">
    <a href="{{ route('user.index') }}" class="float-left" data-value="veiw">
        <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
        Back to all User
    </a><br>
</div><br>
<div class="card">
    <div class="card-header text-uppercase">@lang('Create User')</div>
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="">@lang('Full Name')</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ old('name') }}">
                </div>
                <div class="col-sm-6">
                    <label for="">@lang('Email')</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-sm-6">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                    @error('username')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="col-sm-6">
                    <label for="">@lang('Password')</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="password_confirmation">@lang('Confirm Password')</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <div class="col-sm-6">
                    <label for="">@lang('Role')</label>
                    <select class="form-control ambitious-form-loading select2" name="role" id="role" placeholder="Select role">
                        <option value="{{ old('role') }}" disabled selected>@lang('Select role')</option>
                        @foreach ($roles as $role)
                        @if (old('role') == $role->id)
                        <option value="{{ $role->id }}" selected>
                            {{ $role->name }}</option>
                        @else
                        <option value="{{ $role->id }}">
                            {{ $role->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="image" class="col-form-label">@lang('Profile')</label>
                    <input name="photo" type="file" class="dropify" data-height="100" /><br>
                    @error('photo')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success float-lg-right ml-1">@lang('Save')</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary float-lg-right">@lang('Close')</a>
        </form>
    </div>
</div>
@endsection
