@extends('backends.master')
@section('title','Customer Show')
@section('contents')
    <div class="card">
        <div class="card-header text-uppercase">Customer Detail</div>
        <div class="card-body">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Code')</label>
                        <p>{{ $customer->id}}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Name')</label>
                        <p>{{ ($customer->first_name)}}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Gender')</label>
                        <p>{{ $customer->gender}}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Phone')</label>
                        <p>{{($customer->phone)}}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Type')</label>
                        <p>{{ $customer->relegion }}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Date of Birth')</label>
                        <p>{{ $customer->email }}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3  ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Place Of Birth')</label>
                        <p>{{ $customer->shift }}</p>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4 col-md-3 ">
                        <label class="font-weight-bold mb-1 text-uppercase">@lang('Address')</label>
                        <p>{{ $customer->time }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
