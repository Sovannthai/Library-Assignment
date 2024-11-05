  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success-header text-uppercase">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Create')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('catelog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <label for="">@lang('Code')</label>
                        <input type="text" class="form-control" name="cate_code" placeholder="@lang('Code')">
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Name')</label>
                        <input type="text" class="form-control" name="cate_name" placeholder="@lang('Name')" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('isbn')</label>
                        <input type="text" class="form-control" name="isbn" placeholder="@lang('isbn')">
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Autor Name')</label>
                        <input type="text" class="form-control" name="author_name" placeholder="@lang('Autor Name')" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Publisher')</label>
                        <input type="text" class="form-control" name="publisher" placeholder="@lang('Publisher')">
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Publish Year')</label>
                        <input type="date" class="form-control" name="publishyear" placeholder="@lang('Publish Year')">
                    </div>
                    <div class="col-sm-4">
                        <label for="">@lang('Publish Edition')</label>
                        <input type="text" class="form-control" name="publish_edition" placeholder="@lang('Publish Edition')">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="image" class="col-form-label">@lang('Image')</label>
                        <input name="photo" type="file" class="dropify" data-height="100" /><br>
                        @error('photo')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-sm-right ml-1">@lang('Save')</button>
                <button type="button" class="btn btn-secondary float-sm-right" data-dismiss="modal">@lang('Close')</button>
            </form>
        </div>
      </div>
    </div>
  </div>
