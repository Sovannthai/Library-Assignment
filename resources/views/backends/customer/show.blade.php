@extends('backends.master')
@section('title','Customer Show')
@section('contents')
<div class="back-btn">
    <a href="{{ route('customer.index') }}" class="float-left" data-value="veiw">
        <i class="fa-solid fa-angles-left"></i>&nbsp;&nbsp;
        Back to all Customer
    </a><br>
</div><br>
<div class="card">
    <div class="card-header text-uppercase">Customer Detail</div>
    <div class="card-body">
        <div class="col-sm-12">
            <div class="row">
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Code')</label>
                    <p>{{ $customer->code}}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Name')</label>
                    <p>{{ ($customer->name)}}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Type')</label>
                    <p>{{ ($customer->customer_type->name)}}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Gender')</label>
                    <p>{{ $customer->sex}}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Phone')</label>
                    <p>{{($customer->phone)}}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Date of Birth')</label>
                    <p>{{ $customer->dob }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Place of Birth')</label>
                    <p>{{ $customer->pob }}</p>
                </div>
                <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Address')</label>
                    <p>{{ $customer->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
