<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Create')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer_type.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <label for="">@lang('Name')</label>
                        <input type="text" class="form-control" name="name" placeholder="@lang('Name')" required>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-success float-sm-right ml-1">@lang('Save')</button>
                    <button type="button" class="btn btn-secondary float-sm-right" data-dismiss="modal">@lang('Close')</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
