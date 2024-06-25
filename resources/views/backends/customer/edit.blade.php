@extends('backends.master')
@section('title','Edit Customer')
@section('contents')
<div class="back-btn">
    <a href="{{ route('customer.index') }}" class="float-left" data-value="veiw">
        <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
       @lang('Back to all')
    </a><br>
</div><br>
<div class="card">
    <div class="card-header text-uppercase">@lang('Edit')</div>
    <div class="card-body">
        <form action="{{ route('customer.update',['customer'=>$customer->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-4">
                    <label for="">@lang('Telegram Token')</label>
                    <input type="text" class="form-control" name="telegram_token" placeholder="Enter token" value="{{ $customer->telegram_token }}">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Telegram ID')</label>
                    <input type="text" class="form-control" name="telegram_chat_id" placeholder="Enter id" value="{{ $customer->telegram_chat_id }}">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Code')</label>
                    <input type="text" class="form-control" name="code" value="{{ $customer->code }}">
                    @error('code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Name')</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $customer->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Customer Type')</label>
                    <select class="form-control ambitious-form-loading select2" name="customer_type_id" id="customer_type_id" placeholder="Select type">
                        <option value="{{ old('customer_type_id') }}" disabled selected>@lang('Select')</option>
                        @foreach ($customer_types as $customer_type)
                        @if (old('customer_type_id') == $customer_type->id)
                        <option value="{{ $customer_type->id }}" {{ $customer_type->id  == $customer->customer_type_id ?'selected':'' }} selected>
                            {{ $customer_type->name }}</option>
                        @else
                        <option value="{{ $customer_type->id }}" {{ $customer_type->id  == $customer->customer_type_id ?'selected':'' }}>
                            {{ $customer_type->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('customer_type_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Gender')</label>
                    <select class="form-control" name="sex">
                        <option>@lang('Select')</option>
                        @foreach ($genders as $key=>$gender)
                            <option value="{{ $key }}" {{ $key == $customer->sex ?'selected':'' }}>{{ $gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Phone')</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $customer->phone }}">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Date of Birth')</label>
                    <input type="date" name="dob" class="form-control" value="{{ $customer->dob }}">
                </div>
                <div class="col-sm-4">
                    <label for="">@lang('Telegram Username')</label>
                    <input type="text" name="telegram_username" class="form-control" placeholder="Name" value="{{ $customer->telegram_username }}">
                </div>
                <div class="col-sm-12">
                    <label for="">@lang('Place Of Birth')</label>
                    <textarea name="pob" rows="4" class="form-control">{{ $customer->pob }}</textarea>
                </div>
                <div class="col-sm-12">
                    <label for="">@lang('Address')</label>
                    <textarea name="address" rows="4" class="form-control">{{ $customer->address }}</textarea>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success float-sm-right ml-1">@lang('Save')</button>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary float-sm-right" >@lang('Close')</a>
            </div>
        </form>
    </div>
</div>
@push('js')

@endpush
@endsection
