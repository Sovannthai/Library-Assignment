@extends('backends.master')
@section('title', 'Edit User')
@section('contents')
<div class="back-btn">
    <a href="{{ route('user.index') }}" class="float-left" data-value="veiw">
        <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
        @lang('Back to all')
    </a><br>
</div><br>
<div class="card">
    <div class="card-header text-uppercase">@lang('Edit')</div>
    <div class="card-body">
        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                {{-- <div class="col-sm-4">
                    <label for="">@lang('Telegram Token')</label>
                    <input type="text" class="form-control" name="telegram_token" placeholder="Enter token" value="{{ $user->telegram_token }}">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Telegram ID')</label>
                    <input type="text" class="form-control" name="telegram_chat_id" placeholder="Enter id" value="{{ $user->telegram_chat_id }}">
                </div> --}}
                <div class="col-sm-4">
                    <label for="">@lang('Full Name')</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ $user->name }}">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Email')</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-sm-4">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username" value="{{ $user->username }}">
                    @error('username')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="col-sm-4">
                    <label for="">@lang('Password')</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Role')</label>
                    <select class="form-control ambitious-form-loading select2" name="role" id="role" placeholder="Select role">
                        <option value="{{ old('role') }}" disabled selected>@lang('Select role')</option>
                        @foreach ($roles as $role)
                        @if (old('role') == $role->id)
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @elseif ($user->roles->contains($role->id))
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="photo" class="col-form-label">@lang('Profile')</label>
                    <input name="photo" type="file" class="dropify" data-height="100" data-default-file="{{ url('uploads/all_photo/' . $user->photo) }}" value="{{ $user->photo }}" /><br>
                    <input type="hidden" name="video" value="{{ $user->photo }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success float-lg-right ml-1">@lang('Update')</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary float-lg-right">@lang('Cancel')</a>
        </form>
    </div>
</div>
@endsection
