<div class="modal fade" id="edit-{{ $customer_type->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer_type.update',['customer_type'=>$customer_type->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $customer_type->name }}" required>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary float-sm-right ml-1">Save</button>
                    <button type="button" class="btn btn-secondary float-sm-right" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
