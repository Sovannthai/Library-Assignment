<div class="modal fade" id="edit-{{ $catelog->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Catelog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('catelog.update',['catelog'=>$catelog->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Code</label>
                            <input type="text" class="form-control" name="cate_code" value="{{ $catelog->cate_code }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="cate_name" value="{{ $catelog->cate_name }}" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="">ISBN</label>
                            <input type="text" class="form-control" name="isbn" value="{{ $catelog->isbn }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Autor Name</label>
                            <input type="text" class="form-control" name="author_name" value="{{ $catelog->author_name }}" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="">Publisher</label>
                            <input type="text" class="form-control" name="publisher" value="{{ $catelog->publisher }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Publish Year</label>
                            <input type="date" class="form-control" name="publishyear" value="{{ $catelog->publishyear }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Publish Edition</label>
                            <input type="text" class="form-control" name="publish_edition" value="{{ $catelog->publish_edition }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="image" class="col-form-label">@lang('Image')</label>
                            <input name="photo" type="file" class="dropify" data-height="100" data-default-file="{{ url('uploads/all_photo/' . $catelog->photo) }}" value="{{ $catelog->photo }}" /><br>
                            <input type="hidden" name="photo" value="{{ $catelog->photo }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-sm-right ml-1">Save</button>
                    <button type="button" class="btn btn-secondary float-sm-right" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
