        <div class="modal fade" id="show-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('Customer Detail')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                                    <p>{{ (@$customer->customer_type->name)}}</p>
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
                                    <label class="font-weight-bold mb-1 text-uppercase">@lang('Place Of Birth')</label>
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
            </div>
        </div>
